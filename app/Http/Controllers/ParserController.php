<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function __invoke()
    {
        $input = file_get_contents('https://lifehacker.com/rss');
        $data = simplexml_load_string($input, 'SimpleXMLElement', LIBXML_NOCDATA);

        foreach ($data->channel->item as $value) {
            $this->getPostData((array) $value);
        }

    }

    public function getPostData($postData) {
        if (array_key_exists('category', $postData)) {
            unset($postData['category']);
        }


        Post::firstOrCreate($postData);

    }
}
