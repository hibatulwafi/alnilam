<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\MessageEvent;

class MessageController extends Controller
{
  public function index()
  {
    return view('message/message');
  }

  public function message($user)
  {
    $my_id = auth()->user()->id;
    $target_id = $user;

    $my_room = DB::table('message_room_users');
    $target_room = clone $my_room;
    // Get my room
    $my_room = $my_room->where('user_id', $my_id)->get()->keyBy('room_id')->toArray();
    // Get target room
    $target_room = $target_room->where('user_id', $target_id)->get()->keyBy('room_id')->toArray();

    // Check room
    $room = array_intersect_key($my_room, $target_room);

    // If room exists
    if ($room) return redirect()->route('message.room', ['room' => array_keys($room)[0]]);

    // If room doesn't exist
    // $uuid = Str::orderedUuid();
    // $room = DB::table('message_rooms')->insert([
    //   'id' => $uuid,
    //   'name' => 'generate by system',
    //   'created_at' => now(),
    //   'updated_at' => now()
    // ]);

    // Add users to room
    // DB::table('message_room_users')->insert([
    //   [
    //     'message_room_id' => $uuid,
    //     'user_id' => $my_id,
    //     'created_at' => now(),
    //     'updated_at' => now()
    //   ],
    //   [
    //     'message_room_id' => $uuid,
    //     'user_id' => $target_id,
    //     'created_at' => now(),
    //     'updated_at' => now()
    //   ]
    // ]);

    //return redirect()->route('message.room', ['room' => $uuid]);
  }
  public function room($room)
  {
    // Get room
    $room = DB::table('message_rooms')->where('room_id', $room)->first();
    // Get users
    $users = DB::table('message_room_users')->where('room_id', $room->room_id)->get();

    return view('message/message', compact('room', 'users'));
  }

  public function getMessage($room)
  {
    // Join with user
    $messages = DB::table('messages')
      ->join('users', 'users.id', '=', 'messages.user_id')
      ->where('room_id', $room)
      ->select('messages.*', 'users.name as user_name')
      ->get();

    return response()->json($messages);
  }

  // Send message
  public function sendMessage(Request $request)
  {
    $message = DB::table('messages')->insert([
      'room_id' => $request->room,
      'user_id' => auth()->user()->id,
      'message_content' => $request->message,
      'created_at' => now(),
      'updated_at' => now()
    ]);

    // Trigger event
    broadcast(new MessageEvent($request->room, $request->message, auth()->user()->id));

    return response()->json($message);
  }
}
