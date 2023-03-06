<?php

namespace App\Console\Commands;

use App\Jobs\SendPostNotificationJob;
use App\Models\Post;
use Illuminate\Console\Command;

class SendPostNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-post-notifiaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $posts = Post::whereDate('created_at', '>', now()->subDay())->get();

        foreach ($posts as $post) {
            SendPostNotificationJob::dispatch($post);
        }
    }
}
