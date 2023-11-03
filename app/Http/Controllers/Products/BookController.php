<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Models\Products\Category;
use App\Models\Products\Status;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index() 
    {
        $statuses = Status::get();

        return view('products.books.index', [
            'statuses' => $statuses
        ]);
    }

    public function show($id)
    {
        return view('products.books.show');
    }
}
