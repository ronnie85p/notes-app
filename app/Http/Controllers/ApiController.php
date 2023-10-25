<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    private $error = null;
    private $message = '';

    public function setError($error)
    {
        $this->error = $error;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function response($result=null)
    {
        return response()->json([
            'message' => $this->message,
            'error' => $this->error,
            'result' => $result
        ]);
    }
}