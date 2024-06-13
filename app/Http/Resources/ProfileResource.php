<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_details->customer_id,
            'name' => $this->name,
            'obs_email' => obscureSensitiveData($this->email),
            'obs_phone_number' => obscureSensitiveData($this->phone_number),
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'profile_image' => url($this->customer_details->profile_image),
            'age' => dob_to_age($this->customer_details->dob),
            'profession' => $this->customer_details->profession,
            'location' =>  implode(', ', array_filter([
                $this->customer_details->district->name,
                $this->customer_details->city->name
            ]))
        ];
    }
}
