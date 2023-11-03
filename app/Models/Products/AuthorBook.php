<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    use HasFactory;

    protected $table = 'authors_books';

    protected $fillable = ['authors_id', 'books_id'];

    public $timestamps = false;
}
