<?php

namespace App\Http\Controllers;

use App\Models\Rewiews;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home(){
        return view('home');
    }

    public function go(){
        return view('go');
    }
    public function review(){
        $reviews = new Rewiews();
        return view('review', [
            'reviews' => $reviews->all()
        ]);
    }

    public function review_check(Request $req){
        $valid = $req->validate([
            'email'=> 'required|min:4|max:100',
            'subject' => 'required|min:4|max:100',
            'mess' => 'required|min:15|max:500',
        ]);

        $review = new Rewiews();
        $review->email = $req->input('email');
        $review->subject = $req->input('subject');
        $review->mess = $req->input('mess');

        $review->save();

        return redirect()->route('reviewroute');
    }
}
