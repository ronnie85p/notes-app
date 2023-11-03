<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Products\Category;
use App\Services\Products\BooksHandlerService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.books.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('profile.books.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('profile.books.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::where('parent_id', 0)->get();
        $book = BooksHandlerService::getBook($id);
        $book->loadAuthors();

        return view('profile.books.edit', [
            'categories' => $categories,
            'data' => $book
        ]);
    }
}
