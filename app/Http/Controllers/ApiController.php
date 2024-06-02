<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    protected $resourceClass;

    public function response(array $data = null, $asCollection = false)
    {
        return $asCollection 
            ? $this->resourceClass::collection($data) 
            : new $this->resourceClass($data);
    }
}