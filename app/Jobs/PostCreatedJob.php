<?php

namespace App\Jobs;

use App\Mail\PostCreatedEmail;
use App\Repositories\PostRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PostCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $webSiteId;
    private $postId;
    /**
     * Create a new job instance.
     */
    public function __construct($webSiteId, $postId)
    {
        $this->webSiteId = $webSiteId;
        $this->postId = $postId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $post = resolve(PostRepository::class)->find($this->postId);
        $post->load('website.users');
        foreach ($post->website->users as $user) {
            Mail::to($user->email)->send(new PostCreatedEmail($post));
        }
    }
}
