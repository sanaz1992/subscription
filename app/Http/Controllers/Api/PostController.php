<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Jobs\PostCreatedJob;
use App\Mail\PostCreatedEmail;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        PostCreatedJob::dispatch($post->web_site_id, $post->id);
        return   $post->load('website.users');

        return new PostResource($post);
    }
}
