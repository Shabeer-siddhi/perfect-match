<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerCreateRequest;
use App\Models\AttributesToUser;
use App\Models\CustomerDetails;
use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    function checkUserExists(Request $request)
    {
        $request->validate([
            'email_phone' => 'required'
        ], [
            'email_phone.required' => "Please enter your phone number or email"
        ]);

        $user = User::where('type', 'customer')
            ->where('email', '=', $request->email_phone)
            ->orWhere('phone_number', '=', $request->email_phone)
            ->first();
        if ($user) {
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_phone' => 'required'
        ], [
            'email_phone.required' => "Please enter your phone number or email"
        ]);

        $user = User::whereIn('type', ['customer'])->where('email', $request->email_phone)->orWhere('phone_number', $request->email_phone)->first();

        if ($user != null) {

            $this->rateLimiter($user->id);

            $otp = rand(1000, 9999);

            VerificationCode::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'expire_at' => Carbon::now()->addMinutes(config('app.otp_validity'))
            ]);

            $this->sendOTP($request, $user->id, $otp);

            return response()->json([
                'result' => true,
                'user_id' => $user->id,
                'message' => 'OTP send to user',
                'otp' => app()->isLocal() ? $otp : ''
            ]);
        } else {
            return response()->json(['result' => false, 'message' => 'User not found'], 404);
        }
    }

    function resendOTP(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ], [
            'user_id.required' => "Please provide the user_id"
        ]);

        $otp = rand(1000, 9999);

        VerificationCode::where([
            'user_id' => $request->user_id
        ])->delete();

        VerificationCode::create([
            'user_id' => $request->user_id,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addMinutes(config('app.otp_validity'))
        ]);

        $this->sendOTP($request, $request->user_id, $otp);

        return response()->json([
            'result' => true,
            'user_id' => $request->user_id,
            'message' => 'OTP send to user',
            'otp' => app()->isLocal() ? $otp : ''
        ]);
    }

    function sendOTP(Request $request, $user_id, $otp)
    {
        // code to send otp
    }

    function rateLimiter($user_id)
    {
        if (RateLimiter::tooManyAttempts('send-otp:' . $user_id, $perMinute = 2)) {
            return response()->json(
                [
                    'result' => false,
                    'message' => 'Too many attempts to send OTP'
                ],
                401
            );
        }
        RateLimiter::increment('send-otp:' . $user_id);
    }

    function verifyOTP(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'otp' => 'required'
        ], [
            'user_id.required' => "Please provide the user_id",
            'otp.required' => "Please provide the otp"
        ]);

        $otp_id = VerificationCode::where([
            "user_id" => $request->user_id,
            "otp" => $request->otp
        ])->where('expire_at', '>=', Carbon::now())->first();

        if ($otp_id !== null) {
            $otp_id->delete();
            if ($request->is_login) {
                return $this->loginSuccess($request->user_id);
            } else {
                return response()->json(['result' => true, 'message' => "OTP Verified"], 401);
            }
        } else {
            return response()->json(['result' => false, 'message' => "OTP has expired"], 401);
        }
    }

    function loginSuccess($user_id)
    {
        $user = User::find($user_id);
        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json([
            'result' => true,
            'message' => 'Successfully logged in',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => null,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'result' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email_phone' => 'required'
        ], [
            'name.required' => 'Please enter your full name',
            'email_phone.required' => 'Please enter your phone number or email id'
        ]);

        $is_user  = User::whereIn('type', ['customer'])
            ->where('email', $request->email_phone)
            ->orWhere('phone_number', $request->email_phone)->first();


        if ($is_user) {
            return response()->json([
                'result' => false,
                'message' => "Provided emial/phone number already exists",
            ]);
        }

        if (RateLimiter::tooManyAttempts('register:' . $request->ip(), $perMinute = 2)) {
            return response()->json(
                [
                    'result' => false,
                    'message' => 'Too many attempts to register.'
                ],
                401
            );
        }
        RateLimiter::increment('register:' . $request->ip());

        $otp = rand(1000, 9999);

        $user_id = 'id_' . $request->email_phone;

        VerificationCode::create([
            'user_id' => $user_id,
            'otp' => $otp,
            'expire_at' => Carbon::now()->addMinutes(config('app.otp_validity'))
        ]);

        $this->sendOTP($request, $user_id, $otp);

        return response()->json([
            'result' => true,
            'user_id' => $user_id,
            'message' => 'OTP send to user',
            'otp' => app()->isLocal() ? $otp : ''
        ]);
    }

    function registerDetails(CustomerCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => 'customer',
            'status' => 1,
            'password' => Hash::make(bin2hex(random_bytes(8)))
        ]);

        $image_name = uploadImage($request, 'profile_image', 'profile_image');


        $customer_details = CustomerDetails::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'dob' => Carbon::createFromFormat('d/m/Y', $request->dob),
            'age' => dob_to_age($request->dob),
            'height' => $request->height,
            'education' => $request->education,
            'profession' => $request->profession,
            'sign_up_method' => 'local',
            'profile_image' => $image_name,
            'blood_group' => $request->blood_group,
            'state_id' => 0,
            'city_id' => 0,
            'district_id' => 0,
        ]);

        $customer_details->update([
            'customer_id' =>  "PMU" . str_pad($customer_details->id, 6, 0, STR_PAD_LEFT)
        ]);

        if ($request->hobbies) {
            $hobbies = explode(',', $request->hobbies);
            foreach ($hobbies as  $hobby) {
                $hobbies_array[] = [
                    'attribute_name' => 'hobbies',
                    'attribute_value' => $hobby,
                    'user_id' => $user->id
                ];
            }
            AttributesToUser::insert($hobbies_array);
        }
        if ($request->interest) {
            $interest = explode(',', $request->interest);
            foreach ($interest as  $interests) {
                $insert_array[] = [
                    'attribute_name' => 'interest',
                    'attribute_value' => $interests,
                    'user_id' => $user->id
                ];
            }
            AttributesToUser::insert($insert_array);
        }
        if ($request->family_type) {
            $family_type = explode(',', $request->family_type);
            foreach ($family_type as  $family_types) {
                $insert_array[] = [
                    'attribute_name' => 'family_type',
                    'attribute_value' => $family_types,
                    'user_id' => $user->id
                ];
            }
            AttributesToUser::insert($insert_array);
        }
        if ($request->no_siblings) {
            foreach (explode(',', $request->no_siblings) as  $no_sibling) {
                $insert_array[] = [
                    'attribute_name' => 'no_siblings',
                    'attribute_value' => $no_sibling,
                    'user_id' => $user->id
                ];
            }
            AttributesToUser::insert($insert_array);
        }
        if ($request->family_background) {
            foreach (explode(',', $request->family_background) as  $family_background) {
                $insert_array[] = [
                    'attribute_name' => 'family_background',
                    'attribute_value' => $family_background,
                    'user_id' => $user->id
                ];
            }
            AttributesToUser::insert($insert_array);
        }
        if ($request->preferred_no_siblings) {
            foreach (explode(',', $request->preferred_no_siblings) as  $preferred_no_siblings) {
                $insert_array[] = [
                    'attribute_name' => 'preferred_no_siblings',
                    'attribute_value' => $preferred_no_siblings,
                    'user_id' => $user->id
                ];
            }
            AttributesToUser::insert($insert_array);
        }
        if ($request->preferred_profession) {
            foreach (explode(',', $request->preferred_profession) as  $preferred_profession) {
                $insert_array[] = [
                    'attribute_name' => 'preferred_profession',
                    'attribute_value' => $preferred_profession,
                    'user_id' => $user->id
                ];
            }
            AttributesToUser::insert($insert_array);
        }

        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json([
            'result' => true,
            'message' => 'Successfully registered',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => null,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number
            ]
        ]);
    }
}
