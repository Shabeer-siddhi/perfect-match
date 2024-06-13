<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fav_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
