<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    public $incrementing = false; // important for UUIDs
    protected $keyType = 'string'; // UUIDs are strings

    protected $fillable = ['id', 'name', 'parent_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
    // This allows a sub-category to access its main category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

}
