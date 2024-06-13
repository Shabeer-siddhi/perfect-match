<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Models\Subscription\Packages;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    function packages()
    {
        $packages = Packages::where('status', true)->orderBy('price', 'desc')->get();

        return response()->json([
            'result' => true,
            'packages' => PackageResource::collection($packages)
        ]);
    }
}
