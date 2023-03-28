<?php

namespace App\Http\Services;


use App\Models\Category;
use App\Models\Post;
use DateTime;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class PostService
{
    public function parsePosts($data)
    {
        try {
            foreach ($data->channel->item as $value)
            {
                DB::beginTransaction();
                $postValue = (array)$value;

                if (array_key_exists('category', $postValue))
                {
                    $postCategories = $postValue['category'];
                    unset($postValue['category']);
                }

                $postValue['pubDate'] = $this->createDateObject($postValue['pubDate']);

                $post = Post::firstOrCreate($postValue);

                if (isset($postCategories))
                {
                        $categoryIds = $this->parseCategory($postCategories);
                        $this->attachCategory($post, $categoryIds);
                }

                DB::commit();

        }

        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function storePost($postValue)
    {
        try {
            DB::beginTransaction();

            if (isset($postValue['category']))
            {
                $postCategories = explode(' ', $postValue['category']);
                unset($postValue['category']);
            }

            $post = Post::firstOrCreate($postValue);

            if (isset($postCategories))
            {
                $categoryIds = $this->parseCategory($postCategories);
                $this->attachCategory($post, $categoryIds);
            }

            DB::commit();
            dd(1);
        }
        catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }

        return $post;
   }

    public function updatePost($postValue, $post)
    {
        try {
            DB::beginTransaction();

            if (isset($postValue['category']))
            {
                $postCategories = explode(' ', $postValue['category']);
                unset($postValue['category']);
            }

            $postValue['pubDate'] = (new PostService())
                ->createDateObject($postValue['pubDate']);

            $post->update($postValue);

            if (isset($postCategories))
            {
                $categoryIds = $this->parseCategory($postCategories);
                $post->categories()->sync($categoryIds);
            }

            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }

        return $post;
    }

    public function parseCategory($postCategories)
    {
        if (is_string($postCategories)) {
            $postCategories = array($postCategories);
        }
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

    public static function createDateObject($date) {

        return (new \DateTime())->createFromFormat(env('FORMAT_DATE'), $date);
    }

    public function createDbDateObject($date) {
        return (new \DateTime())
            ->createFromFormat('Y-m-d H:i:s', $date);
    }

    public function changeFormatDate($date) {

        return (date_format($date, env('FORMAT_DATE')));
    }

    public function showAllPosts($postCollection) {
        $postArray = array();
        foreach ($postCollection as $postModel) {
            $post = $postModel->toArray();

            $post['pubDate'] = $this
                ->createDbDateObject($post['pubDate']);

            $post['pubDate'] = $this
                ->changeFormatDate($post['pubDate']);

            array_push($postArray, $post);
        }
        return $postArray;
    }
}
