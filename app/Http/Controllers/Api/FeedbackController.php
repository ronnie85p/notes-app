<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FeedbackRequest;
use App\Http\Controllers\Controller;
use App\Services\FeedbackService;
use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        return new Resource(FeedbackService::getList());
    }

    public function store(FeedbackRequest $request)
    {
        $validated = $request->validated();

        return new Resource(FeedbackService::send($validated));
    }
}
