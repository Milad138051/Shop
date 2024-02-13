<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductReview extends Model
{
    use HasFactory;
	 
    protected $table='product_reviews';
    
   protected $guarded = ['id'];
 
   
   public function product()
   {
       return $this->belongsTo(Product::class);
   }

   public function user()
   {
       return $this->belongsTo(User::class);
   }


   public function categoryAttribute()
   {
       return $this->belongsTo(CategoryAttribute::class);
   }


}
