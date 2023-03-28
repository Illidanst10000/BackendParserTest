<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(type="object"),
 */


class Category extends Model
{
    /**
     *  @OA\Property(
     *      property="title",
     *      type="string"
     *  ),
     */

    use HasFactory;

    protected $table = 'categories';
    protected $guarded = false;

    public function users() {
        return $this->belongsToMany(User::class, 'post_category');
    }
}
