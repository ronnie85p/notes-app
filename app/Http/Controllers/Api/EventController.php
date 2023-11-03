<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\Models\Event;

class EventController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->response(EventService::getAll());
    }

    public function creatorIndex(Request $request)
    {
        return $this->response(EventService::getAllByCreator());
    }

    public function members(int $id) 
    {
        return $this->response(EventService::getMembers($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        return $this->response(EventService::create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id)
    {
        return $this->response(EventService::get($id));
    }

    public function join(Request $request, int $id)
    {
        return $this->response(EventService::join($id));        
    }

    public function leave(Request $request, int $id)
    {
        return $this->response(EventService::leave($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        return $this->response(EventService::delete($id));
    }
}
