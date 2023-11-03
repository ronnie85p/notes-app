<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FeedbackRequest;
use App\Http\Controllers\Controller;
use App\Services\FeedbackService;
use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function resource($data)
    {
        return new Resource($data);
    }

    public function index(Request $request)
    {
        return new Resource(FeedbackService::getList($request->input()));
    }

    public function store(FeedbackRequest $request)
    {
        $validated = $request->validated();

        return $this->resource(FeedbackService::send($validated));
    }
}
