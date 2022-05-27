<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = false;
    protected $dateFormat = 'D, d M Y H:i:s \G\M\T';
    protected $fillable = ['title', 'link', 'description', 'pubDate', 'guid'];

    public function categories() {
        return $this->belongsToMany(Category::class, 'post_category');
    }


}
