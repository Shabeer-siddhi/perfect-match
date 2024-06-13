<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone_number' => 'required|unique:users,phone_number',
            'dob' => 'required',
            'height' => 'required',
            'blood_group' => 'required',
            'profession' => 'required',
            'education' => 'required',
            'gender' => 'required',
            'profile_image' => 'required|image|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'name.min' => 'Name must be alteast 3 letters',
            'email.required' => 'Please enter your email',
            'email.email' => 'Email seems invalid, please check again',
            'email.unique' => 'Email already exists',
            'phone_number.required' => 'Please enter your phone number',
            'phone_number.unique' => 'Phone number already exists',
            'gender.required' => 'Please enter your gender',
            'height.required' => 'Please enter your height',
            'blood_group.required' => 'Please enter your blood group',
            'education.required' => 'Please enter your education',
            'profession.required' => 'Please enter your profession',
            'status.required' => 'Please select a status',
            'profile_image.required' => 'Please select a image',
            'profile_image.image' => 'Invalid image, please choose another image',
            'profile_image.max' => 'Image must be less than 5mb',
            'profile_image.uploaded' => 'Image failed to upload, please check the image size or try another image',
        ];
    }
}
