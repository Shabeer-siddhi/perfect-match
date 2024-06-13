<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function adminAsset($path)
{
    return asset("adminassets/" . $path);
}


function dob_to_age($dob)
{
    if (gettype($dob) == 'string') {
        return date_diff(date_create_from_format('d/m/Y', $dob), date_create('today'))->y;
    }
    return date_diff($dob, date_create('today'))->y;
}


function cleanFileName($file_name_str)
{
    $file_name_str = str_replace(' ', '-', $file_name_str);
    $file_name_str = preg_replace('/[^A-Za-z0-9.\-\_]/', '', $file_name_str);
    $file_name_str = preg_replace('/-+/', '-', $file_name_str);
    return $file_name_str;
}

/**
 * Image Upload Helper
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  string $input
 * @param  string $path
 * @param  boolean $uniqueName
 * @return \Illuminate\Http\Response
 */
function uploadImage($request, $input, $path, $uniqueName = true)
{
    if ($request->hasFile($input)) {
        $uploadedFile = $request->file($input);
        $filename =   time() . $uploadedFile->getClientOriginalName();
        if (!$uniqueName) {
            $filename = $uploadedFile->getClientOriginalName();
        }

        $name = Storage::disk('public')->putFileAs(
            $path,
            $uploadedFile,
            $filename
        );

        return Storage::url($name);
    }
    return null;
}

function obscureSensitiveData($data)
{
    $middleLength = strlen($data) - (strlen($data) / 2);
    return substr($data, 0, 2) . str_repeat('*', $middleLength) . substr($data, -2);
}

function packageValidity($validity)
{
    switch ($validity) {
        case 0:
            return "Unlimited";
            break;
        case $validity < 12:
            return $validity . ' ' . Str::plural('month', $validity);
            break;
        case $validity >= 12:
        default:
            $years = intval($validity / 12);
            $months = $validity - (12 * $years);
            $rtn = $years . ' ' . Str::plural('year', $years);
            if ($months > 0) {
                $rtn .= ', ' .  $months . ' ' . Str::plural('month', $months);
            }
            return $rtn;
            break;
    }
}
