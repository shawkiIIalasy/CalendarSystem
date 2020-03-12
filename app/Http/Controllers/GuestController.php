<?php

namespace App\Http\Controllers;

use App\Guest;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\Invite;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function addGuests($event,$guests)
    {
        foreach($guests as $guest) {
           $message="hello";
           $notification=new NotificationController();
           $notification->pushNotify(Auth::user()->id,$guest['id'],$message);
            Guest::create([
                'event_id' => $event->id,
                'user_id' => $guest['id'],
            ]);
        }
    }
    public function push()
    {
        $notification=new NotificationController();
        $notification->pushNotify(Auth::user()->id,5,'fdskjkjkldsf');
    }
}
