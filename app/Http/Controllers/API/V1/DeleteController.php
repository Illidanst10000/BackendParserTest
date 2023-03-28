<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use OpenApi\Annotations as OA;

class DeleteController extends Controller
{
    /**
     * @OA\Delete (
     * path="/api/v1/posts/{id}",
     * operationId="postDelete",
     * summary="Delete Post",
     * tags={"Posts"},
     * description="Delete post by ID",
     *
     *     @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="Post ID",
     *          required=true,
     *            @OA\Schema(
     *               type="integer",
     *               required={"id"},
     *        ),
     *     ),
     *      @OA\Response(
     *          response=204,
     *          description="Deleted Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Post not found",
     *          @OA\JsonContent()
     *       )
     * )
     */
    public function __invoke($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();
        return response()->json(null, 204);
    }
}
