<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnswerQuestion extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='answer_question';
    protected $guarded=['id'];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function answers()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function activeAnswers()
    {
		return $this->answers()->where('approved', 1)->get();
    }
}
