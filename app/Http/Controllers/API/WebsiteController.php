<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWebsiteRequest;
use App\Models\Website;

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
}
