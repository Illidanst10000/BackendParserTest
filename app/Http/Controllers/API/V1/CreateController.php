<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use OpenApi\Annotations as OA;

class CreateController extends Controller
{


    /**
     * @OA\Post(
     * path="/api/v1/posts",
     * operationId="postCreate",
     * summary="Create Post",
     * tags={"Posts"},
     * description="Create Post",
     *     @OA\RequestBody(
     *     description="pubDate format: D d M Y H:i:s GMT",

     *         @OA\MediaType(
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
     *       )
     * )
     *
     *
     *
     *               @OA\Property(property="title", type="string", example="Example title"),
     *               @OA\Property(property="link", type="string", example="google.com"),
     *               @OA\Property(property="description", type="string", example="Example description),
     *               @OA\Property(property="pubDate", type="date"),
     *               @OA\Property(property="category", type="array", @OA\Items(), example="["Ford", "BMW", "jojo"]"),
     *               @OA\Property(property="guid", type="string", example="184986510"),
     */

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $data['pubDate'] = PostService::createDateObject($data['pubDate']);

        $post = (new PostService())
            ->storePost($data);

        return response()->json($post, 201);
    }
}
