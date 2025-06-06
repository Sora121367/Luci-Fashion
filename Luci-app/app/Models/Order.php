<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['id','session_id','user_id','status','total_price','payment_method'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
   public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
