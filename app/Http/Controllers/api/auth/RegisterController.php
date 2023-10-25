<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Services\Auth\RegisterService;

class RegisterController extends ApiController
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'password_again' => 'required',
            'date_of_birth' => 'nullable',
            'agreed' => 'required'
        ]);

        RegisterService::register($data);

        return $this->response([
            'url' => route('profile')
        ]);
    }
}
