<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MyProfile\UpdateRequest;
use App\Http\Resources\MyProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyProfileController extends Controller
{

    public function my_profile(Request $request)
    {
        return [
            'status' => true,
            'dataa' => new MyProfileResource($request->user())
        ];
    }

    public function update(UpdateRequest $request)
    {
        $customer_details = $request->user()->customer_details()->get()->first();

        if ($request->hasFile('profile_image')) {
            $profile_image = $image_name = uploadImage($request, 'profile_image', 'profile_image');

            $customer_details->update([
                'profile_image' => $profile_image
            ]);
        }

        if ($request->has('images')) {
            $images = [];
            foreach ($request->images as $image) {
                $filename =   time() . $image->getClientOriginalName();
                $name = Storage::disk('public')->putFileAs(
                    'galler_image',
                    $image,
                    $filename
                );
                $images[] = Storage::url($name);
            }

            if (!empty($images)) {
                $old_images = explode(',', $customer_details->images);

                if ($customer_details->images !== null && $customer_details->images !== "") {
                    $all_images = array_merge($old_images, $images);
                } else {
                    $all_images = $images;
                }

                $request->user()->customer_details()->update([
                    'images' => implode(',', $all_images)
                ]);
            }
        }

        return [
            'status' => true,
            'data' => $request->user()
        ];
    }


    public function verify_profile(Request $request)
    {
        $request->validate([
            'government_id' => 'file|mimes:png,jpg,jpeg,pdf,doc,dox|max:5120',
            'selfi_images' => 'image|max:5120',
        ], [
            'government_id.required' => "Pleae upload a government id",
            'government_id.file' => "Pleae upload a government id",
            'government_id.mimes' => "Pleae upload a file in png,jpg,jpeg,pdf,doc,dox format",
            'government_id.max' => 'File must be less than 5mb',
            'government_id.uploaded' => 'File failed to upload, please check the file size or try another file',

            'selfi_images.required' => "Pleae upload a government id",
            'selfi_images.file' => "Pleae upload a government id",
            'selfi_images.mimes' => "Pleae upload a file in png,jpg,jpeg,pdf,doc,dox format",
            'selfi_images.max' => 'File must be less than 5mb',
            'selfi_images.uploaded' => 'File failed to upload, please check the file size or try another file',
        ]);

        if ($request->hasFile('government_id')) {
            $government_id = uploadImage($request, 'government_id', 'government_id');
            $request->user()->customer_details()->get()->first()->update([
                'government_id' => $government_id,
                'is_verified' => 2
            ]);
        }
        if ($request->hasFile('selfi_images')) {
            $selfi_images = uploadImage($request, 'selfi_images', 'selfi_images');
            $request->user()->customer_details()->get()->first()->update([
                'selfi_images' => $selfi_images,
                'is_verified' => 2
            ]);
        }

        return [
            'status' => true,
            'message' => "Files uploaded successfully"
        ];
    }

    public function delete_image(Request $request)
    {
        $request->validate([
            'type' => "required",
            'image_url' => "required",
        ], [
            'type.required' => "Pleae provide a type",
            'image_url.required' => "Pleae provide a image URL",
        ]);

        $customer_details = $request->user()->customer_details()->get()->first();

        $image_to_delete = parse_url($request->image_url, PHP_URL_PATH);

        if ($request->type == 'images') {
            $images = explode(',', $customer_details->images);
            $new_image = array_diff($images, [$image_to_delete]);
            $customer_details->update([
                'images' => implode(',', $new_image)
            ]);
        } else if ($request->type == 'government_id' || $request->type == 'selfi_images') {
            $customer_details->update([
                $request->type => NULL
            ]);
        }

        return [
            'status' => true,
            'message' => "File deleted successfully"
        ];
    }
}
