<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const FILE_PATH = 'uploads/posts/';
    const PHOTO_SIZE = ['500', '500'];
    const PHOTO_SMALL_SIZE = ['150', '150'];

    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'web_site_id'];

    public function getCreatedAtDateAttribute()
    {
        return verta($this->created_at);
    }

    public function getImageAddressAttribute()
    {
        if (isset($this->image)) {
            return ENV('APP_URL') . '/' . self::FILE_PATH . $this->image;
        } else {
            return ENV('APP_URL') . '/uploads/no-image.jpg';
        }
    }
}
