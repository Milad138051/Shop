<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory , SoftDeletes;

	protected $casts = ['image' => 'array'];

	protected $fillable=['title','url','image','position','status'];
	
	
	public static $positions = [
        0   =>  'اسلاید شو (صفحه اصلی)',
        1   =>  'کنار اسلاید شو (صفحه اصلی)',
        2   =>  ' بنر تبلیغی بعد اسلایدر  (صفحه اصلی)',
        3   =>  'جزو 4 بنر تبلیغی وسط صفحه (صفحه اصلی)',
        4   =>  'جزو 2 بنر تبلیغی بزرگ انتهای صفحه (صفحه اصلی)',

    ];}
