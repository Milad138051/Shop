<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Market\Order;
use App\Models\Market\Compare;
use App\Models\Market\Payment;
use App\Models\Market\Product;
use App\Models\Market\OrderItem;
use Laravel\Sanctum\HasApiTokens;
use App\Models\market\ProductReview;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Permissions\HasPermissionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use SoftDeletes;
    use HasFactory;
    use Notifiable;
    use HasPermissionTrait;


    protected $fillable = [
        'name',
		'first_name',
		'last_name',
		'mobile',
        'email',
        'password',
		'profile_photo_path',
		'status',
		'activation',
		'user_type',
		'mobile_verified_at',
		'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


	public function getFullNameAttribute(){

		return $this->first_name.' '.$this->last_name;
	}
	
	// public function ticketAdmin()
	// // {
	// // 	return $this->hasOne(TicketAdmin::class);
	// // }

	// // public function tickets()
	// // {
	// // 	return $this->hasMany(Ticket::class);
	// // }

	public function payments()
    {
        return $this->hasMany(Payment::class);
    }

	public function addresses()
    {
        return $this->hasMany(Address::class);
    }

	public function orders()
    {
        return $this->hasMany(Order::class);
    }

	public function products()
	{
		return $this->belongsToMany(Product::class);
	}
	
	public function orderItems()
    {
        return $this->hasManyThrough(OrderItem::class, Order::class);
    }
   
   public function isUserPurchedProduct($product_id)
    {
        $productIds = collect();
        foreach ($this->orderItems()->where('product_id', $product_id)->get() as $item) {
            $productIds->push($item->product_id);
        }
        $productIds = $productIds->unique();
        return $productIds;
    }

    public function compare()
    {
        return $this->hasOne(Compare::class);
    }

    public function reviews()
	{
		return $this->hasMany(ProductReview::class);
	}

    public function isAdmin()
    {
        if($this->user_type==1)
        {
            return true;
        }else{
            return false;
        }
    }
}
