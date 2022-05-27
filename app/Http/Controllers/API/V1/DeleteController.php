<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;

class DeleteController extends Controller
{
    public function __invoke($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();
        return response()->json(null, 204);
    }
}
