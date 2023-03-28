<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\PostService;
use App\Models\Post;
use OpenApi\Annotations as OA;

class ShowController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * @OA\Get(
     *     path="/api/v1/posts/{id}",
     *     summary="Get post by id",
     *     tags={"Posts"},
     *     description="Get post by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Post id",
     *         required=true,
     *              @OA\Schema(
     *               type="integer",
     *               required={"id"},
     *        ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Post is not found",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function __invoke($id)
    {
        $postModel = Post::find($id);

        if (is_null($postModel)) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post = $postModel->toArray();

        $post['pubDate'] = $this->postService
            ->createDbDateObject($post['pubDate']);

        $post['pubDate'] = $this->postService
            ->changeFormatDate($post['pubDate']);

        return response()->json($post, 200);
    }
}
