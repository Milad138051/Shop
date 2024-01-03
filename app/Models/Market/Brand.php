<?php

namespace App\Models\Market;

use App\Models\Market\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

  protected $fillable = ['original_name', 'persian_name', 'logo', 'status','tags'];
  
    protected $casts = ['logo' => 'array'];
	
    public function product()
	{
		return $this->hasMany(Product::class);
	}
}
