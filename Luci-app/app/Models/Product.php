<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'category_id',
        'price',
        // 'size',
        'description',
        'image_path',
        // 'status',
    ];

    // No need to cast 'size' since it's stored as ENUM (string)
    // protected $casts = ['size' => 'array'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // In Category.php
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

}
