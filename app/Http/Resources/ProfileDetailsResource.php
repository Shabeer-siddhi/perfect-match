<?php

namespace App\Http\Resources;

use App\Models\Subscription\Packages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = [];

        foreach (explode(',', $this->customer_details->images) as $image) {
            if ($image) {
                $images[] = url($image);
            }
        }

        $attributes = [];

        foreach ($this->attributes as $attribute) {
            $attributes[] = [
                'name' => $attribute->attribute_name,
                'value' => $attribute->attribute_value,
            ];
        }

        return [
            'id' => $this->id,
            'customer_id' => $this->customer_details->customer_id,
            'name' => $this->name,
            'obs_email' => obscureSensitiveData($this->email),
            'obs_phone_number' => obscureSensitiveData($this->phone_number),
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'profile_image' => url($this->customer_details->profile_image),
            'dob' => $this->customer_details->dob ? Carbon::parse($this->customer_details->dob)->format('d/m/Y') : '',
            'age' => dob_to_age($this->customer_details->dob),
            'gender' => $this->customer_details->gender,
            'height' => $this->customer_details->height,
            'religion' => $this->customer_details->religion,
            'cast' => $this->customer_details->cast,
            'income' => $this->customer_details->income,
            'blood_group' => $this->customer_details->blood_group,
            'profession' => $this->customer_details->profession,
            'district' =>  $this->customer_details->district->name,
            'city' =>  $this->customer_details->city->name,
            'state' =>  $this->customer_details->state->name,
            'images' =>  $images,
            'short_bio' => $this->customer_details->short_bio,
            'bio' => $this->customer_details->bio,
            'views' => $this->customer_details->views,
            'likes' => $this->customer_details->likes,
            'partner_preference' => $this->customer_details->partner_preference,
            'attributes' => $attributes,
        ];
    }
}
