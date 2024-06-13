<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns',
            'phone_number' => 'required',
            'gender' => 'required',
            'height' => 'required',
            'blood_group' => 'required',
            'education' => 'required',
            'profession' => 'required',
            'status' => 'required',
            'image' => 'required|image|max:5120',
            'password' => [
                'required',
                'confirmed',
                // Password::min(6)->letters()->mixedCase()->numbers()
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter customer name',
            'name.min' => 'Name must be alteast 3 letters',
            'email.required' => 'Please enter customer email',
            'email.email' => 'Email seems invalid, please check again',
            'phone_number.required' => 'Please enter customer phone number',
            'gender.required' => 'Please enter customer gender',
            'height.required' => 'Please enter customer height',
            'blood_group.required' => 'Please enter customer blood group',
            'education.required' => 'Please enter customer education',
            'profession.required' => 'Please enter customer profession',
            'status.required' => 'Please select a status',
            'image.required' => 'Please select a image',
            'image.image' => 'Invalid image, please choose another image',
            'image.max' => 'Image must be less than 5mb',
            'image.uploaded' => 'Image failed to upload, please check the image size or try another image',
        ];
    }
}
