<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'type',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        if (Auth::user()->type == 'admin') {
            return true;
        }
        return false;
    }

    public function scopeNotSelf(Builder $query, $id): void
    {
        $query->whereNot('id', $id);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function scopeCustomer(Builder $query): void
    {
        $query->where('type', 'customer');
    }

    public function customer_details()
    {
        return $this->hasOne(CustomerDetails::class);
    }

    public function attributes()
    {
        return $this->hasMany(AttributesToUser::class);
    }
    public function hobbies()
    {
        return $this->hasMany(AttributesToUser::class)->where('attribute_name', '=', 'hobbies');
    }
    public function interests()
    {
        return $this->hasMany(AttributesToUser::class)->where('attribute_name', '=', 'interests');
    }
    public function family_type()
    {
        return $this->hasMany(AttributesToUser::class)->where('attribute_name', '=', 'family_type');
    }
    public function no_siblings()
    {
        return $this->hasMany(AttributesToUser::class)->where('attribute_name', '=', 'no_siblings');
    }
    public function family_background()
    {
        return $this->hasMany(AttributesToUser::class)->where('attribute_name', '=', 'family_background');
    }
    public function preferred_profession()
    {
        return $this->hasMany(AttributesToUser::class)->where('attribute_name', '=', 'preferred_profession');
    }

    public function favorite()
    {
        return $this->hasMany(FavouriteList::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }
}
