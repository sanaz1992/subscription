<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscrip extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'web_site_id'];

    public function website(): BelongsTo
    {
        return $this->belongsTo(website::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
