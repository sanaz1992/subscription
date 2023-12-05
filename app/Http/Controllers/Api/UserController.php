<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserRepository $userRepository, Request $request)
    {
        $users = $userRepository->all($request->order_by ?? null);
        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->store($request->all());
        return new UserResource($user);
    }
}
