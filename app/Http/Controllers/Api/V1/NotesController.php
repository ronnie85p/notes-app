<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Notes\StoreRequest;
use App\Http\Requests\Notes\UpdateRequest;
use App\Http\Resources\NotesResource;
use App\Services\Notes\NotesService;

class NotesController extends ApiController
{
    function __construct(
        private NotesService $service,
    ) { }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return NotesResource::collection(
            $this->service->getList($request->query())
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return new NotesResource(
            $this->service->create($request->validated())
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new NotesResource(
            $this->service->getItem($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        return new NotesResource(
            $this->service->update($id, $request->all())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return new NotesResource(
            $this->service->delete($id)
        );
    }
}
