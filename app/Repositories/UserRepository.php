<?php

namespace App\Repositories;

use App\Models\Subscrip;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function all($orderBy = 'created_at_desc')
    {
        $users = User::query();
        switch ($orderBy) {
            case 'created_at_desc':
                $users = $users->latest();
                break;
            case 'created_at':
                $users = $users->orderBy('created_at');
                break;
        }
        $users = $users->get();
        return $users;
    }

    public function store($data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'mobile' => $data['mobile'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
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
