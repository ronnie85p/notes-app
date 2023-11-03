<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Book;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name'];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'authors_books', 'authors_id', 'books_id');
    }

    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
