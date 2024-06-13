<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessagesListResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all_message(Request $request)
    {
        $userId = $request->user()->id;

        $latestMessages = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->select(
                DB::raw('CASE WHEN sender_id = ' . $userId . ' THEN receiver_id ELSE sender_id END as user_id'),
                DB::raw('MAX(created_at) as last_message_time')
            )
            ->groupBy('user_id')
            ->orderBy('last_message_time', 'desc')
            ->get();

        $contactUserIds = $latestMessages->pluck('user_id');
        $orderedIds = $contactUserIds->implode(',');

        $contacts = User::whereIn('id', $contactUserIds)
            ->orderByRaw("FIELD(id, $orderedIds)")
            ->with('customer_details')
            ->get();

        return response()->json([
            'result' => true,
            'messages' => MessagesListResource::collection($contacts),
        ]);
    }

    public function get_message(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ], [
            'user_id.required' => 'Please provide a user_id'
        ]);
        $userId1 = $request->user()->id;
        $userId2 = $request->user_id;

        $messages = Message::where(function ($query) use ($userId1, $userId2) {
            $query->where('sender_id', $userId1)
                ->where('receiver_id', $userId2);
        })->orWhere(function ($query) use ($userId1, $userId2) {
            $query->where('sender_id', $userId2)
                ->where('receiver_id', $userId1);
        })->orderBy('created_at', 'asc') // You can change to 'desc' if you want latest messages first
            ->get();

        return response()->json([
            'result' => true,
            'messages' => MessageResource::collection($messages),
        ]);
    }

    public function send_message(Request $request)
    {
        $request->validate([
            'user_id' => "required",
            'message' => "required"
        ], [
            'user_id.required' => "Please provide a user_id",
            'message.required' =>  "Please enter a message"
        ]);

        $message = Message::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->user_id,
            'message' => $request->message,
        ]);

        return response()->json([
            'result' => true
        ]);
    }
}
