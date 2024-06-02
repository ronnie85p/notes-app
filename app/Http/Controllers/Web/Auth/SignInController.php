<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('auth/signin');
    }
}
