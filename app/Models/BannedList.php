<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'banned_user',
        'reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
