<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use App\Models\Post;

class ParserController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function __invoke()
    {
        $input = file_get_contents(env('FEED_URL'));
        $data = simplexml_load_string($input, 'SimpleXMLElement', LIBXML_NOCDATA);
        $this->postService->parsePosts($data);
    }
}
