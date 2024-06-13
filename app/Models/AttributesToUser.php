<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributesToUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_name',
        'attribute_value',
        'user_id',
    ];
}
