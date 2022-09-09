<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateController extends Controller
{
    public function content(){
//        $user = Auth::user();
//        dd($user->name);
        return view('user.private');
    }
}
