<?php

namespace App\Http\Controllers;

use App\Client;
use App\Event;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function Sodium\add;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $user=User::with('client')->where('id','=',Auth::user()->id)->first();
        $client=$user->client;
        session(['client'=>$client]);
        return view('home');
    }
}
