<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Post;

class ParsingService
{
    public function parsePosts($data)
    {
        foreach ($data->channel->item as $value)
        {
            $postValue = (array)$value;

            if (array_key_exists('category', $postValue))
            {
                $postCategories = $postValue['category'];
                unset($postValue['category']);
            }

            $postValue['pubDate'] = (new \DateTime())
                ->createFromFormat('D, d M Y H:i:s \G\M\T', $postValue['pubDate']);



            $post = Post::firstOrCreate($postValue);

            if (isset($postCategories))
            {
                $categoryIds = $this->parseCategory($postCategories);
                $this->attachCategory($post, $categoryIds);
            }
        }
    }

    public function parseCategory($postCategories)
    {
        foreach ($postCategories as $categoryTitle)
        {
            $categoryData = ['title' => $categoryTitle];
            $category = Category::firstOrCreate($categoryData);

            $categoryIds[] = $category->id;
        }
        return $categoryIds;
    }

    public function attachCategory($post, $categoryIds)
    {
        foreach ($categoryIds as $categoryId)
        {
            $post->categories()->attach($categoryId);
        }
    }
}
