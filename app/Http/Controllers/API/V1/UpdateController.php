<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use OpenApi\Annotations as OA;

class UpdateController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * @OA\Put (
     * path="/api/v1/posts/{id}",
     * operationId="postUpdate",
     * summary="Update Post",
     * tags={"Posts"},
     * description="Update Post by ID",
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
     *     @OA\RequestBody(
     *     description="pubDate format: D d M Y H:i:s GMT",
     *     required=true,
     *            @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"title", "link", "description", "pubDate", "guid"},
     *
     *               @OA\Property(property="title", type="string"),
     *               @OA\Property(property="link", type="string"),
     *               @OA\Property(property="description", type="string"),
     *               @OA\Property(property="pubDate", type="string"),
     *               @OA\Property(property="category", type="string"),
     *               @OA\Property(property="guid", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Created Successfully",
     *          @OA\JsonContent()
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Post not found",
     *          @OA\JsonContent()
     *       ),
     * )
     */

    public function __invoke(UpdateRequest $request, $id)
    {
        $post = Post::find($id);

        if (is_null($post))
        {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $data = $request->validated();

        $post = $this->postService
            ->updatePost($data, $post);

        return response()->json($post, 200);
    }
}
