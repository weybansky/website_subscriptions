<?php

namespace App\Models;

use App\Models\Website;
use App\Models\PostNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function notifications()
    {
        return $this->belongsTo(PostNotification::class);
    }
}
