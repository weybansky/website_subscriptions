<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\CreateWebsiteRequest;
use App\Jobs\SendPostNotificationJob;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateWebsiteRequest $request)
    {
        $user = Website::create($request->validated());

        return response()->json([
            'message' => 'Website Created',
            'data' => $user,
        ]);
    }

    public function storePost(Website $website, CreatePostRequest $request)
    {
        $post = $website->posts()->create($request->validated());

        SendPostNotificationJob::dispatch($post);

        return response()->json([
            'message' => 'Post Published',
            'data' => $post,
        ]);
    }

    public function subscribeUser(Website $website, Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
        ], [
            'user_id.required' => 'Please provide user Id',
        ]);

        if ($website->subscriptions()->where('user_id', $request->user_id)->exists()) {
            return response()->json([
                'message' => 'You are already subscribed to website',
            ], 400);
        }

        $website->subscriptions()->create(['user_id' => $request->user_id]);

        return response()->json([
            'message' => 'You are now subscribed to the website',
            'data' => $website,
        ]);
    }
}
