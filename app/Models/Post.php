<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(type="object"),
 */

class Post extends Model
{
    /**
     *  @OA\Property(
     *      property="title",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="link",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="description",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="pubDate",
     *      type="date"
     *  ),
     *  @OA\Property(
     *      property="guid",
     *      type="integer"
     *  )
     */

    use HasFactory;

    protected $table = 'posts';
    protected $guarded = false;
    protected $fillable = ['title', 'link', 'description', 'pubDate', 'guid'];

    public function categories() {
        return $this->belongsToMany(Category::class, 'post_category');
    }


}
