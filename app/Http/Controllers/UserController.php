<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function saveNewUser(Request $req){
        if(Auth::check()){
            return redirect(route('user.private'));
        }
        $valid = $req->validate([
            'name'=>'required|min:2',
            'email'=>'required|email',
            'password'=>'required|min:2',
        ]);
        if(User::where('email', $valid['email'])->exists()){
            return redirect(route('user.registration'))->withErrors([
                'formError' => 'Есть такой email'
            ]);
        }


        $user = User::create($valid);
        if($user){
            Auth::login($user);
            return redirect(route('user.private'));
        }

        return redirect(route('user.registration'))->withErrors([
            'formError' => 'Ошибка при регистрации'
        ]);
    }

    public function login(Request $req){
        if(Auth::check()){
            return redirect(route('user.private'));
        }

        $fields = $req->only(['email', 'password']);
//        dd($fields);
        if(Auth::attempt($fields, true)){
            return redirect()->intended(route('user.private'));
        }
        return redirect(route('user.login'))->withErrors([
            'formError' => 'Ошибка авторизации'
        ]);

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
