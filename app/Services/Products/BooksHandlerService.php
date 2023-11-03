<?php

namespace App\Services\Products;

use App\Models\Products\Book;
use App\Models\Products\Author;
use App\Models\Products\Category;
use App\Models\Products\Status;
use App\Models\Products\AuthorBook;
use App\Models\Profile\Settings;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BooksHandlerService 
{
    public static $uploads_path = 'uploads/books/';
    public static $storage_in = 'public';
    public static $filename_generated_len = 40;

    public static function storage()
    {
        return Storage::disk(self::$storage_in);
    }

    public static function createBook(array $data, $file)
    {
        DB::transaction(function () use ($data, $file): Book {
            $status = Status::create(['name' => 'PUBLISHED']);
            $data['status_id'] = $status->id;
            $book = Book::create($data);
            self::updateAuthors($book, $data['authors']);
            self::saveFileToBook($book, $file);

            return $book;
        });

        return ['url' => route('profile.books.index')];
    }

    public static function updateBook($id, array $data)
    {
        DB::transaction(function () use ($id, $data): Book {
            $book = Book::findOrFail($id);
            $book->update($data);

            return $book;
        });

        return ['url' => route('profile.books.index')];
    }

    public static function updateAuthors(Book $book, array $authors)
    {
        foreach ($authors as $author) {
            $names = array_map('trim', explode(' ', $author));
            $first_name = trim($names[0]);
            $last_name = empty($names[1]) ? '' : trim($names[1]);

            $author = Author::firstOrCreate([
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);

            AuthorBook::create([
                'authors_id' => $author->id,
                'books_id' => $book->id
            ]);
        }
    }

    public static function saveFileToBook(Book $book, $file)
    {
        $uploads_path = self::$uploads_path . $book->isbn . '/thumbs';

        self::storage()->makeDirectory($uploads_path);
        $path = $file->store($uploads_path, self::$storage_in);

        $book->update(['thumbnail_url' => $path]);
    }

    public static function getList(array $params = [])
    {
        $limit = empty($params['limit']) ? 15 : (int)$params['limit'];
        $search = empty($params['search']) ? '' : strtolower(trim($params['search']));
        $search_by = empty($params['searchby']) ? 'title' : $params['searchby'];

        $settings = Settings::first();
        if ($settings) {
            if (empty($params['limit']) && !empty($settings->books_limit_on_page)) {
                $limit = $settings->books_limit_on_page;
            }
        }

        $qb = Book::groupBy('id');

        if (!empty($params['status_id']) && (int)$params['status_id'] > 0) {
            $qb = Book::where('status_id', $params['status_id']);
        }

        if (!empty($params['categories'])) {
            $categories =  array_map('trim', explode(',', $params['categories']));

            $qb = $qb->whereIn('category_id', $categories);
        }

        if (!empty($search)) {
            if ($search_by == 'author') {
                
            } else {
                $qb = $qb->where($search_by, 'LIKE', "%{$search}%");
            }
        }

        $results = $qb->take($limit)->get();
        $results->load('status', 'category', 'authors');
        return $results;
    }

    public static function getBook($id)
    {
        $book = Book::findOrFail($id);
        $book->load('status', 'category', 'authors');
        $book->loadAuthors();

        return $book;
    }

    public static function delete($id)
    {
        DB::transaction(function () use($id) {
            AuthorBook::where('books_id', $id)->delete();
            $deleted = Book::destroy($id);

            return $deleted;
        });
    }
}