<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(PostRepository $postRepository, Request $request)
    {
        $posts = $postRepository->all($request->order_by ?? null);
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request, PostRepository $postRepository)
    {
        $post = $postRepository->store($request->all());
        return new PostResource($post);
    }
}
