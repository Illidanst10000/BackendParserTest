<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Services\PostService;
use App\Models\Post;

class CreateController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $post = (new PostService())
            ->storePost($data);

        return response()->json($post, 201);
    }
}
