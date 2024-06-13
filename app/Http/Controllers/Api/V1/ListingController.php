<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileDetailsResource;
use App\Http\Resources\ProfileResource;
use App\Models\CustomerDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    function listing(Request $request)
    {
        $customer_details = $request->user()->customer_details()->withOut(['state', 'city', 'district'])->first();
        $partner_preference = $customer_details->partner_preference;

        $query = User::notSelf($request->user()->id)->customer()->active()->with(['customer_details','attributes']);

        $query->whereHas('customer_details', function ($q) use ($partner_preference, $customer_details) {
            $q->notBanned()->gender($customer_details->gender);
            if (isset($partner_preference['profession'])) {
                $q->orWhere('profession', 'LIKE', "%{$partner_preference['profession']}%");
            }
        });

        // if (isset($partner_preference['no_siblings']) || isset($partner_preference['family_type'])) {
        //     $query->whereHas('attributes', function ($q) use ($partner_preference) {
        //         if (isset($partner_preference['no_siblings'])) {
        //             $q->where([
        //                 [
        //                     'attribute_name', 'LIKE', 'no_siblings'
        //                 ],
        //                 [
        //                     'attribute_value', 'LIKE', "%{$partner_preference['no_siblings']}%"
        //                 ]
        //             ]);
        //         }
        //         if (isset($partner_preference['family_type'])) {
        //             $q->orWhere([
        //                 [
        //                     'attribute_name', 'LIKE', 'family_type'
        //                 ],
        //                 [
        //                     'attribute_value', 'LIKE', "%{$partner_preference['family_type']}%"
        //                 ]
        //             ]);
        //         }
        //     });
        // }


        if (isset($partner_preference['no_siblings'])) {
            $query->whereHas('no_siblings', function ($q) use ($partner_preference) {
                $q->where(
                    'attribute_value',
                    'LIKE',
                    "%{$partner_preference['no_siblings']}%"
                );
            });
        }
        if (isset($partner_preference['family_type'])) {
            $query->whereHas('family_type', function ($q) use ($partner_preference) {
                $q->where(
                    'attribute_value',
                    'LIKE',
                    "%{$partner_preference['family_type']}%"
                );
            });
        }

        $profiles = $query->get();

        return [
            'status' => true,
            'data' => ProfileResource::collection($profiles)
        ];
    }

    function profile(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ], [
            'id.required' => 'Please provide a user id'
        ]);


        $user = User::active()->customer()->with([
            'customer_details',
            'attributes'
        ])->find($request->id);

        if (!$user) {
            return [
                'status' => false,
                'data' => null,
            ];
        }

        return [
            'status' => true,
            'data' => new ProfileDetailsResource($user),
        ];
    }
}
