<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes/create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('notes.edit', [
            'id' => $id,
        ]);
    }
}
