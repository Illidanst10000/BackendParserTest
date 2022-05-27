<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $id)
    {
        $post = Post::find($id);

        if (is_null($post))
        {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $data = $request->validated();

        $post = (new PostService())
            ->updatePost($data, $post);

        return response()->json($post, 200);
    }
}
