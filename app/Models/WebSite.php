<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WebSite extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'persian_name', 'url'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'subscrips');
    }
}
