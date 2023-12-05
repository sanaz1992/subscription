<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\Post;
use App\Models\Subscrip;

class PostRepository
{
    public function all($orderBy = 'created_at_desc')
    {
        $posts = Post::query();
        switch ($orderBy) {
            case 'created_at_desc':
                $posts = $posts->latest();
                break;
            case 'created_at':
                $posts = $posts->orderBy('created_at');
                break;
        }
        $posts = $posts->get();
        return $posts;
    }

    public function find($id)
    {
        return Post::find($id);
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image'] = Helper::uploadFile($data['image'], Post::FILE_PATH, null, Post::PHOTO_SIZE, Post::PHOTO_SMALL_SIZE);
        }
        return Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
            'web_site_id' => $data['web_site_id'],
        ]);
    }

    public function subscrip($data)
    {
        Subscrip::create([
            'user_id' => $data['user_id'],
            'web_site_id' => $data['web_site_id'],
        ]);
    }
}
