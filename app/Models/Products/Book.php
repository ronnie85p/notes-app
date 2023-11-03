<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Category;
use App\Models\Products\Author;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn', 
        'title', 
        'page_count', 
        'published_at', 
        'short_description',
        'long_description',
        'thumbnail_url',
        'status_id',
        'category_id'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'authors_books', 'books_id', 'authors_id');
    }

    public function loadAuthors()
    {
        $this->load('authors');
        $authors = $this->authors->map(fn($author) => $author->getFullname());

        $this->str_authors = implode(', ', $authors->toArray());
    }
}
