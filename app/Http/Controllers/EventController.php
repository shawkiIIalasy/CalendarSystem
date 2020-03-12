<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function submit(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);
        $event = Event::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'start_date' => $request['sdate'],
            'end_date' => $request['edate'],
            'start_time' => $request['stime'],
            'end_time' => $request['etime'],
            'client_id' => Auth::user()->client_id,
            'user_owner_id' => Auth::user()->id,
        ]);
        if (!empty($request['selected'])) {
            $guest = new GuestController();
            $guest->addGuests($event, $request['selected']);
        }
        return response()->json($request, 200);
    }

    public function getEventDate(Request $request)
    {
        $user = User::with('client')->where('id', '=', Auth::user()->id)->first();
        $client = $user->client_id;
        $GLOBALS['request'] = $request;
        $data = Event::
        where('client_id', $user->client_id)
            ->where(function ($query) {
                $query->where('start_date', '>=', $GLOBALS['request']['y'] . '-' . ($GLOBALS['request']['m'] + 1) . '-1')
                    ->orWhere('end_date', '>=', $GLOBALS['request']['y'] . '-' . ($GLOBALS['request']['m'] + 1) . '-1');
            })
            ->get();
        return response()->json($data, 200);
    }

    public function view($id)
    {
        $event = Event::with(['user', 'guest' =>
            function ($query) {
                $query->with('user');
            }
        ])->where('id', $id)->get();
        return view('event/view', compact('event'));
    }
}
