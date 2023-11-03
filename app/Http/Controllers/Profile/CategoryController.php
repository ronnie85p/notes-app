<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Products\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('profile.categories.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('profile.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::where('parent_id', 0)->get();
        $category = Category::findOrFail($id); 

        return view('profile.categories.edit', [
            'categories' => $categories,
            'data' => $category
        ]);
    }
}
