<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CustomerAttribute;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    function getAllAttributes()
    {
        return CustomerAttribute::select('attribute_name', 'attribute_value')->get()->groupBy('attribute_name');
    }

    function getAttributes($name)
    {
        return CustomerAttribute::select('attribute_name', 'attribute_value')
            ->where('attribute_name', 'like', $name)
            ->get();
    }
}
