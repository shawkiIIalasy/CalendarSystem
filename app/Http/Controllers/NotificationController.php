<?php

namespace App\Http\Controllers;

use App\Message;
use App\Notifications\Invite;
use App\User;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pushNotify($userId, $toUserId, $message)
    {
        $fromUser = User::find($userId);
        $toUser = User::find($toUserId);
        $details = [
            'from' => $userId,
            'to' => $toUserId,
            'data' => $message
        ];
        // send notification using the "user" model, when the user receives new message
        $toUser->notify(new Invite($details));
    }

    public function makeAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(null, 200);
    }

    public function getNotificationsCount()
    {
        $count = auth()->user()->unreadNotifications->count();

        return response()->json($count, 200);

    }

}
