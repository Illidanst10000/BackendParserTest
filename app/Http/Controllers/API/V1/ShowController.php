<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\PostService;
use App\Models\Post;

class ShowController extends Controller
{
    public function __invoke($id)
    {
        $postModel = Post::find($id);

        if (is_null($postModel)) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post = $postModel->toArray();
       // return response()->json($post['pubDate']);
        $post['pubDate'] = (new PostService())
            ->createDbDateObject($post['pubDate']);

        $post['pubDate'] = (new PostService())
            ->changeFormatDate($post['pubDate']);

        return response()->json($post, 200);
    }
}
