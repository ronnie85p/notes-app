<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Requests\Profile\DeleteRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Resources\ProfileResource;
use App\Services\Profile\ProfileService;
use Illuminate\Auth\Authenticatable;

class ProfileController extends Controller
{
    function __construct(
        private ProfileService $service
    ) {}

    public function update(UpdateRequest $request)
    {
        return new ProfileResource(
            $this->service->update($request->user(), $request->validated())
        );
    }

    public function delete(DeleteRequest $request)
    {
        return new ProfileResource(
            $this->service->delete($request->user())
        );
    }

    public function updatePassword(UpdatePasswordRequest $request) 
    {
        return new ProfileResource(
            $this->service->updatePassword($request->user(), $request->validated())
        );
    }
}
