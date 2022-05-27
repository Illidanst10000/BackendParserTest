<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class CreateController extends Controller
{
    public function __invoke(PostRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);
        return response()->json($post);
    }
}
