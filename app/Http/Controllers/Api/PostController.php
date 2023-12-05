<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreSendEmailSubscripsRequest;
use App\Http\Resources\PostResource;
use App\Jobs\PostCreatedJob;
use App\Models\User;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
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
        PostCreatedJob::dispatch($post->web_site_id, $post->id);
        return new PostResource($post);
    }

    public function sendEmailSubscrips(StoreSendEmailSubscripsRequest $request)
    {
        $post = resolve(PostRepository::class)->find($request->post_id);
        PostCreatedJob::dispatch($post->web_site_id, $post->id);
        return response()->json([
            'status' => true,
            'message' => 'ایمیل برای کاربران ارسال میشود',
        ], 200);
    }
}
