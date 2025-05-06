<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'cart_id', 'products_id', 'size', 'quantity'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
