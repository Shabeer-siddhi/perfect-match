<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BannedList;
use App\Models\DislikeList;
use App\Models\FavouriteList;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    function like(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id'
        ], [
            'user_id.required' => 'Please provide a user_id',
            'user_id.exists' => 'Provide user_id does not exist'
        ]);

        $like = Like::where([
            'liker_id' => $request->user()->id,
            'liked_profile_id' => $request->user_id
        ])->first();

        if ($like) {
            $like->delete();
            return response()->json([
                'result' => true,
                'status' => 0,
                'messgae' => 'Like removed'
            ]);
        }

        Like::create([
            'liker_id' => $request->user()->id,
            'liked_profile_id' => $request->user_id
        ]);

        return response()->json([
            'result' => true,
            'status' => 1,
            'message' => "Profile liked"
        ]);
    }

    function favorite(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ], [
            'user_id.required' => 'Please provide a user_id',
            'user_id.exists' => 'Provide user_id does not exist'
        ]);

        $fav = FavouriteList::where([
            'user_id' => $request->user()->id,
            'fav_user_id' => $request->user_id
        ])->first();

        if ($fav) {
            return response()->json([
                'result' => true,
                'status' => 0,
                'messgae' => 'Already favorited'
            ]);
        }

        FavouriteList::create([
            'user_id' => $request->user()->id,
            'fav_user_id' => $request->user_id
        ]);

        return response()->json([
            'result' => true,
            'status' => 1,
            'message' => "Profile favorited"
        ]);
    }

    function remove_favorite(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ], [
            'user_id.required' => 'Please provide a user_id'
        ]);

        FavouriteList::where([
            'user_id' =>  $request->user()->id,
            'fav_user_id' => $request->user_id
        ])->delete();

        return response()->json([
            'result' => true,
            'status' => 1,
            'message' => "Favorite removed"
        ]);
    }

    function dislike(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ], [
            'user_id.required' => 'Please provide a user_id'
        ]);

        DislikeList::updateOrCreate([
            'user_id'  =>  $request->user()->id,
            'disliked_user_id' => $request->user_id
        ]);

        return response()->json([
            'result' => true,
            'status' => 1,
            'message' => "Profile disliked"
        ]);
    }

    function ban(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ], [
            'user_id.required' => 'Please provide a user_id'
        ]);

        BannedList::updateOrCreate([
            'user_id'  =>  $request->user()->id,
            'banned_user' => $request->user_id
        ]);

        return response()->json([
            'result' => true,
            'status' => 1,
            'message' => "Profile banned"
        ]);
    }
}
