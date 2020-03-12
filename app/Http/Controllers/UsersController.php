<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $user=User::with('client')
            ->where('client_id',Auth::user()->client_id)
            ->where('id','!=',Auth::user()->id)
            ->get();
        return response()->json($user,200);
    }
}
