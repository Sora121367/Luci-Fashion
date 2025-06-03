<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $fillable = ['id', 'order_id','price', 'products_id', 'size', 'quantity'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
