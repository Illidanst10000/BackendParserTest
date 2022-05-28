<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\PostService;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $postCollection = Post::all();
        $postCollection = (new PostService())->showAllPosts($postCollection);
        return response()->json($postCollection, 200);
    }
}
