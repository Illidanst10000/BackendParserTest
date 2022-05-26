<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function __invoke()
    {
        $input = file_get_contents('https://lifehacker.com/rss');

        $data = simplexml_load_string($input, 'SimpleXMLElement', LIBXML_NOCDATA);

        $this->parsePosts($data);

    }

    public function parsePosts($data)
    {
        foreach ($data->channel->item as $value) {
            $postValue = (array)$value;

            if (array_key_exists('category', $postValue)) {
                $postCategories = $postValue['category'];
                unset($postValue['category']);
            }

            $postValue['pubDate'] = (new \DateTime())->createFromFormat('D, d M Y H:i:s \G\M\T', $postValue['pubDate']);

            $post = Post::firstOrCreate($postValue);

            if (isset($postCategories)) {
                $categoryIds = $this->parseCategory($postCategories);

                foreach ($categoryIds as $categoryId) {
                    $post->categories()->attach($categoryId);
                }
            } else {
                $post->categories()->delete();
            }

        }

        dd("completed");
    }

    public function parseCategory($postCategories)
    {
        foreach ($postCategories as $categoryTitle) {
            $categoryData = ['title' => $categoryTitle];
            $category = Category::firstOrCreate($categoryData);
            $categoryIds[] = $category->id;
        }
        return $categoryIds;
    }

}
