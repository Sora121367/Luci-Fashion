<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteProduct extends Model
{
    protected $table = 'favorite_product';
    protected $fillable = ['id', 'user_id', 'session_id', 'products_id'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
