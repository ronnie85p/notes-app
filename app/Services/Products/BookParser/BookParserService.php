<?php

namespace App\Services\Books;

use App\Models\Products\Book;
use App\Models\Products\Status;
use App\Models\Products\Category;
use App\Models\Products\Author;
use App\Models\Products\AuthorBook;
use App\Services\Books\BookParserException;

class BookParserService 
{
    public static $root_dir = 'public/';
    public static $uploads_dir = 'uploads/books/';
    public static $new_category_name = 'NEWS';

    public static function handle(string $source_url, ?Callable $callback)
    {
        $count = 0;
        $data = self::fetchData($source_url);
        foreach ($data->all() as $item) {
            if ($count > 5) break;

            try {

                self::checkItem($item);
                self::checkBookExists($item);
    
                // Checking for status
                self::checkStatus($item);
    
                $status = self::saveStatus($item['status']);
                $category = empty($item['categories']) 
                    ? self::newCategory() 
                    : self::saveCategories($item['categories']);
    
                $item['status_id'] = $status->id;
                $item['category_id'] = $category->id;
    
                $book = self::saveBook($item);
    
                // Download thumbnail book
                self::downloadThumbnail($book, $out_file);
    
                $book->thumbnail_url = $out_file;
                $book->save();
    
                // Check for authors
                if (!empty($item['authors']) && is_array($item['authors'])) {
                    self::saveAuthors($item['authors'], $book);
                }
    
                self::handleCallback($callback, [$book]);

            } catch (BookParserException $e) {
                echo $e->getMessage();
                continue;
            }

            $count++;
        }
    }

    public static function fetchData(string $url) 
    {
        return collect(json_decode(file_get_contents($url), true));
    }

    public static function handleCallback(?Callable $callback, array $args)
    {
        return call_user_func($callback, $args);
    }

    public static function checkItem(array $item)
    {
        if (empty($item['isbn'])) {
            throw new BookParserException("Не указан ISBN '{$item['title']}.'");
        }
    }

    public static function checkBookExists(array $item)
    {
        if (Book::where('isbn', $item['isbn'])->exists()) {
            throw new BookParserException("Такая книга уже существует '{$item['isbn']}'");
        }
    }

    public static function saveBook(array $data)
    {
        $published_at = isset($data['publishedDate']) ? $data['publishedDate']['$date'] : null;
        $book = new Book([
            'isbn' => $data['isbn'],
            'title' => $data['title'] ?? '',
            'page_count' => $data['pageCount'] ?? 0,
            'published_at' => date('Y-m-d h:i:s', strtotime($published_at)),
            'short_description' => $data['shortDescription'] ?? '',
            'long_description' => $data['longDescription'] ?? '',
            'thumbnail_url' => $data['thumbnailUrl'] ?? '',
            'status_id' => $data['status_id'],
            'category_id' => $data['category_id']
        ]);

        if ($book->save() !== true) {
            throw new BookParserException("Ошибка сохранения книги '{$data['isbn']}'.");
        }

        return $book;
    }

    public static function checkStatus(array $item)
    {
        if (empty($item['status'])) {
            throw new BookParserException("Не указан статус '{$item['isbn']}'");
        }
    }

    public static function saveStatus(string $name) 
    {
        $status = Status::where('name', $name)->first();
        if (empty($status)) {
            $status = new Status([
                'name' => $name,
            ]);

            if ($status->save() !== true) {
                throw new BookParserException("Ошибка сохранения статуса '{$name}'.");
            }
        }

        return $status;
    }

    public static function saveCategories(array $categories)
    {
        $last_category = false;
        foreach ($categories as $category_name) {
            $category_name = trim($category_name);
            $category = Category::where('name', $category_name)->first();
            if (is_null($category)) {
                $category = new Category([
                    'parent_id' => $last_category ? $last_category->id : 0,
                    'name' => $category_name,
                ]);

                if ($category->save() !== true) {
                    throw new BookParserException("Ошибка сохранения категории '{$category_name}'.");
                }
            }

            $last_category = $category;
        }

        return $last_category;
    }

    public static function newCategory()
    {
        $category = new Category([
            'parent_id' => 0,
            'name' => self::$new_category_name,
        ]);

        if ($category->save() !== true) {
            throw new BookParserException("Ошибка сохранения категории '{self::$new_category_name}'.");
        }

        return $category;
    }

    public static function saveAuthors(array $authors, Book $book)
    {
        foreach ($authors as $author) {
            $names = array_map('trim', explode(' ', $author));
            $first_name = $names[0] ?? '';
            $last_name = $names[1] ?? '';

            if (empty($first_name) && empty($last_name)) {
                continue;
            }

            $qb = Author::where('first_name', $first_name);
            if (!empty($last_name)) {
                $qb->where('last_name', $last_name);
            }

            if ($qb->exists() === false) {
                $author = new Author([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                ]);

                if ($author->save()) {
                    AuthorBook::create([
                        'authors_id' => $author->id,
                        'books_id' => $book->id,
                    ]);
                }
            }
        }
    }

    public static function buildPath(string $path, $perm = 0777)
    {
        if (!file_exists(self::$root_dir . $path)) {
            mkdir(self::$root_dir . $path, $perm, true);
        }

        return $path;
    }

    public static function downloadThumbnail(Book $book, &$out_file)
    {
        if (empty($book->thumbnail_url)) return;

        $thumbs_dir = self::buildPath(self::$uploads_dir. 'isbn'. $book->isbn.'/thumbs') . '/';
        $out_file = $thumbs_dir . basename($book->thumbnail_url);
        $options = array(
            CURLOPT_FILE    => fopen(self::$root_dir . $out_file, 'w'),
            CURLOPT_URL     => $book->thumbnail_url,
            CURLOPT_TIMEOUT =>  28800,
        );
    
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code < 200 || $http_code >= 300) {
            throw new BookParserException("Ошибка загрузки файла '{$book->thumbnail_url}' -> '{self::$root_dir . $out_file}'", $http_code);
        }
    }
}