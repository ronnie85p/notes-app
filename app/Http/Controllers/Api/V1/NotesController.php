<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Notes\StoreRequest;
use App\Http\Requests\Notes\UpdateRequest;
use App\Http\Resources\NotesResource;
use App\Services\Notes\Core as NotesService;

class NotesController extends ApiController
{
    function __construct(
        private NotesService $service,
    ) {
        $this->resourceClass = NotesResource::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $list = $this->service->getList($request->query());

        return NotesResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $item = $this->service->create($request->validated());

        return new NotesResource([
            'redirect' => route('home'),
            'item' => $item
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = $this->service->getItem($id);

        return new NotesResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->service->update($id, $request->all());

        return new NotesResource([
            'redirect' => route('home')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);

        return new NotesResource(null);
    }
}
