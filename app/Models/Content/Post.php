<?php

namespace App\Models\Content;

use App\Models\Content\PostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $casts = ['image' => 'array'];
    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }
	
	public function comments()
	{
		return $this->morphMany('App\Models\Content\Comment','commentable');
	}
}
