<?php

namespace App\Models\Market;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Market\CartItem;
use App\Models\Market\Category;
use Nagy\LaravelRating\Traits\CanRate;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nagy\LaravelRating\Traits\Rateable;


class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable, Rateable;

	public function sluggable(): array
    {
        return[
            'slug' =>[
                'source' => 'name',
            ]
        ];
    }

    protected $fillable = ['name', 'introduction', 'slug', 'image', 'status', 'tags','price', 'marketable', 'sold_number', 'frozen_number', 'marketable_number', 'brand_id', 'category_id','related_categories', 'published_at'];

  
    protected $casts = ['image' => 'array'];
	
	
	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}
	
	public function comments()
    {
        return $this->morphMany('App\Models\Content\Comment', 'commentable');
    }
	
	public function category()
	{
		return $this->belongsTo(Category::class);
	}
		
	public function metas()
	{
		return $this->hasMany(ProductMeta::class);
	}
	
	public function colors()
	{
		return $this->hasMany(ProductColor::class);
	}
	
	public function images()
	{
		return $this->hasMany(Gallery::class);
	}
	 
	public function CategoryValues()
	{
		 return $this->hasMany(CategoryValue::class);
	}
	 
	 public function guarantees()
	{
		return $this->hasMany(Guarantee::class);
	}
	 
	 public function amazingSales()
	{
		 return $this->hasMany(AmazingSale::class);
	}
	
	public function activeAmazingSale()
	{
		return $this->amazingSales->where('start_date','<',Carbon::now())->where('end_date','>',Carbon::now())->where('status',1)->first();
	}
	
	public function activeComments()
    {
        return $this->comments()->where('approved', 1)->whereNull('parent_id')->get();
    }
	
	public function user()
	{
		return $this->belongsToMany(User::class);
	}	
	
	public function compares()
	{
		return $this->belongsToMany(Compare::class);
	}

	public function reviews()
	{
		return $this->hasMany(ProductReview::class);
	}


	public function questions()
	{
		return $this->hasMany(AnswerQuestion::class);
	}

	public function activeQuestions()
	{
        return $this->questions()->where('approved', 1)->whereNull('parent_id')->get();
	}
	
}
