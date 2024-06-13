<?php

namespace App\Models\Subscription;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'packages_id',
        'amount',
        'transaction_id',
        'status',
    ];

    function user()
    {
        $this->belongsTo(User::class);
    }

    function package()
    {
        $this->belongsTo(Packages::class);
    }
}
