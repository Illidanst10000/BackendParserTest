<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $postCollection = Post::all();
        $postArray = array();
        foreach ($postCollection as $postModel) {
            $post = $postModel->toArray();

            $post['pubDate'] = (new \DateTime())
                ->createFromFormat('Y-m-d H:i:s', $post['pubDate']);
            $post['pubDate'] = (date_format($post['pubDate'], 'D, d M Y H:i:s \G\M\T'));
            array_push($postArray, $post);
        }

        return response()->json($postArray, 200);
    }
}
