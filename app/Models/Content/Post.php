<?php

namespace App\Models\Content;

use App\Models\User;
use App\Models\Content\PostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory,SoftDeletes;
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

    public function user()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function activeComments()
    {
        return $this->comments()->where('approved', 1)->whereNull('parent_id')->get();
    }
}
