<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostNotification extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = ['subscribers_id' => 'array'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
