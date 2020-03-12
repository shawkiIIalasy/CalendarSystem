<?php

namespace App\Http\Controllers;

use App\Notifications\Invite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Notification;
class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pushNotify($userId,$toUserId,$message)
    {
        // user 2 sends a message to user 1
        /*$message = new Message;
        $message->setAttribute('from', $userId);
        $message->setAttribute('to', $toUserId);
        $message->setAttribute('message', $message);
        $message->save();*/

        $fromUser = User::find($userId);
        $toUser = User::find($toUserId);

        // send notification using the "user" model, when the user receives new message
        $toUser->notify(new Invite($fromUser));
    }

}
