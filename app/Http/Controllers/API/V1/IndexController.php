<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\PostService;
use App\Models\Post;
use OpenApi\Annotations as OA;

class IndexController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * @OA\Get  (
     * path="/api/v1/posts",
     * operationId="postsAll",
     * summary="Show all Posts",
     * tags={"Posts"},
     * description="Show all post",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Posts",
     *
     *          @OA\JsonContent()
     *      ),
     * )
     */

    public function __invoke()
    {
        $postCollection = Post::all();
        $postCollection = $this->postService->showAllPosts($postCollection);
        return response()->json($postCollection, 200);
    }
}
