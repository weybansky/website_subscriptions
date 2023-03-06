<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribers()
    {
        return $this->hasManyThrough(User::class, Subscription::class);
    }
}
