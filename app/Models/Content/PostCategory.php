<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=['id'];
    protected $casts = ['image' => 'array'];

    public function posts()
    {
        return $this->hasMany(Post::class,'category_id');
    }
    
}
