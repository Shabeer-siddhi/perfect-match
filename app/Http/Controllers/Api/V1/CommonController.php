<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Location\City;
use App\Models\Location\District;
use App\Models\Location\State;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function state(Request $request)
    {
        return [
            'status' => true,
            'data' => State::all()
        ];
    }

    public function district(Request $request)
    {
        return [
            'status' => true,
            'data' => District::where('state_id', $request->state_id)->get()
        ];
    }

    public function city(Request $request)
    {
        return [
            'status' => true,
            'data' => City::where('district_id', $request->district_id)->get()
        ];
    }
}
 