<?php

namespace App\Http\Requests\Api\MyProfile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'profile_image' => 'image|max:5120',
            'images.*' => 'image|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'profile_image.image' => 'Invalid image, please choose another image',
            'profile_image.max' => 'Image must be less than 5mb',
            'profile_image.uploaded' => 'Image failed to upload, please check the image size or try another image',

            'images.*.image' => 'Invalid image, please choose another image',
            'images.*.max' => 'Image must be less than 5mb',
            'images.*.uploaded' => 'Image failed to upload, please check the image size or try another image',
        ];
    }
}
