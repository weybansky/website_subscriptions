<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\CreateWebsiteRequest;
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

        // TODO Notify subscribers

        return response()->json([
            'message' => 'Post Published',
            'data' => $post,
        ]);
    }
}
