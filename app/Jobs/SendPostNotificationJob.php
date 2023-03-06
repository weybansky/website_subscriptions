<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\PostNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\UserPostNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class SendPostNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Post $post)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // get post notification
        $postNotification = PostNotification::firstOrCreate([
            'post_id' => $this->post->id,
        ], [
            'website_id' => $this->post->website_id,
        ]);

        $website = $this->post->website;

        $postNotification = PostNotification::firstOrCreate([
            'post_id' => $this->post->id,
        ], [
            'website_id' => $this->post->website_id,
        ]);

        $notifiedUserIds = $postNotification->subscribers_id ?? [];
        $unNotifiedUserIds = $website->subscriptions()->whereNotIn('user_id', $notifiedUserIds)->pluck('user_id');

        $users = User::whereIn('id', $unNotifiedUserIds)->get();

        array_push($notifiedUserIds, ...$unNotifiedUserIds);
        $postNotification->subscribers_id = $notifiedUserIds;
        $postNotification->save();

        Notification::send($users, new UserPostNotification($this->post));
    }
}
