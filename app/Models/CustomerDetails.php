<?php

namespace App\Models;

use App\Models\Location\City;
use App\Models\Location\District;
use App\Models\Location\State;
use App\Models\Subscription\Packages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    use HasFactory;

    protected $with = ['state', 'city', 'district', 'package'];

    protected $fillable = [
        'user_id',
        'customer_id',
        'gender',
        'dob',
        'age',
        'height',
        'education',
        'profession',
        'state_id',
        'city_id',
        'district_id',
        'religion',
        'cast',
        'income',
        'blood_group',
        'profile_image',
        'images',
        'short_bio',
        'bio',
        'packages_id',
        'package_expiry',
        'sign_up_method',
        'views',
        'likes',
        'profile_completed',
        'is_banned',
        'partner_preference',
        'is_verified',
        'government_id',
        'selfi_images',
    ];

    protected $casts = [
        'dob' => 'date',
        'partner_preference' => 'array'
    ];

    public function scopeNotBanned(Builder $query): void
    {
        $query->where('is_banned', 0);
    }

    public function scopeGender(Builder $query, $gender): void
    {
        $query->whereNot('gender', $gender);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function package()
    {
        return $this->belongsTo(Packages::class);
    }
}
