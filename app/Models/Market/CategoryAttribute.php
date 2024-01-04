<?php

namespace App\Models\Market;

use App\Models\Market\Category;
use App\Models\Market\CategoryValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryAttribute extends Model
{
    use HasFactory,SoftDeletes;
  protected $guarded = ['id'];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function values()
	 {
		 return $this->hasMany(CategoryValue::class);
	 }
}
