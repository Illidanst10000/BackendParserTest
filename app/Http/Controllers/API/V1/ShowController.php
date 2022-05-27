<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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

        $post['pubDate'] = (new \DateTime())
            ->createFromFormat('Y-m-d H:i:s', $post['pubDate']);
        $post['pubDate'] = (date_format($post['pubDate'], 'D, d M Y H:i:s \G\M\T'));

        return response()->json($post, 200);
    }
}
