<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\User;

class Feedback extends Model
{
    use HasUuids;

    protected $table = 'feedbacks';

    // Set fillable fields (exclude 'id' as it is auto-generated)
    protected $fillable = [
        'user_id',
        'title',
        'reason',
        'comments'
    ];

    // UUID primary key config
    public $incrementing = false;
    protected $keyType = 'string';

    // Define relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
