<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.feedbacks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('profile.feedbacks.show');
    }
}
