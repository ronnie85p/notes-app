<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Requests\Profile\DeleteRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Resources\ProfileResource;
use App\Services\Profile\Core as ProfileService;

class ProfileController extends Controller
{
    function __construct(
        private ProfileService $service
    ) {}

    public function update(UpdateRequest $request)
    {
        return new ProfileResource(
            $this->service->update($request->validated())
        );
    }

    public function delete(DeleteRequest $request)
    {
        return new ProfileResource(
            $this->service->delete()
        );
    }

    public function updatePassword(UpdatePasswordRequest $request) 
    {
        return new ProfileResource(
            $this->service->updatePassword($request->validated())
        );
    }
}
