<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateBookRequest;
use App\Http\Requests\Products\UpdateBookRequest;
use App\Http\Resources\Resource;
use App\Services\Products\BooksHandlerService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function resource($data)
    {
        return new Resource($data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Resource::collection(BooksHandlerService::getList($request->input()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request)
    {
        $validated = $request->validated();

        return $this->resource(BooksHandlerService::createBook($validated, $request->file('poster')));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->resource(BooksHandlerService::getBook($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, string $id)
    {
        $validated = $request->validated();

        return $this->resource(BooksHandlerService::updateBook($id, $validated));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->resource(BooksHandlerService::delete($id));
    }
}
