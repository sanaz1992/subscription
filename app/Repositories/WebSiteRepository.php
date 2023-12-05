<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\WebSite;
use Illuminate\Support\Facades\Hash;

class WebSiteRepository
{
    public function all($orderBy = 'created_at_desc')
    {
        $websites = WebSite::query();
        switch ($orderBy) {
            case 'created_at_desc':
                $websites = $websites->latest();
                break;
            case 'created_at':
                $websites = $websites->orderBy('created_at');
                break;
        }
        $websites = $websites->get();
        return $websites;
    }

    public function store($data)
    {
        return WebSite::create([
            'name' => $data['name'],
            'persian_name' => $data['persian_name'],
            'url' => $data['url'],
        ]);
    }
}
