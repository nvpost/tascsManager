<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Rewiews;
use App\Models\TeamsUserMeta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home(){
        if(!Auth::user()){
            return view('home');
        }
        $user_id = Auth::user()->id;

        $teams = TeamsUserMeta::with(['getTeams', 'getTeams.getTeamMeta', 'getTeams.getTeamMeta.getProjects'])
            ->where(['user_id'=>$user_id]);

        $teams = TeamsUserMeta::with(['getTeams', 'getTeams.getTeamMeta', 'getTeams.getTeamMeta.getProjects'])
            ->where(['user_id'=>$user_id])
            ->get()
            ->toArray();

        $tp = TeamsUserMeta::with(['getProjects'])
            ->where(['user_id'=>$user_id]);

        $projects = Projects::with(['getTeamMeta'])
            ->where(['user_id'=>$user_id])
            ->get()
            ->toArray();

        $teamsAndProjects = [];
        //get team projects
        foreach ($teams as $item){
            foreach ($item['get_teams'] as $get_team){
                foreach ($get_team['get_team_meta'] as $get_team_meta){
                    foreach ($get_team_meta['get_projects'] as $get_projects){
                        array_push($teamsAndProjects, [
                            'id'=>$get_projects['id'],
                            'label' => $get_projects['label'],
                            'description' => $get_projects['description'],
                            'team' => $get_team['name'],
                            'team_id' => $get_team['id'],
                            ]);
                    }
                }
            }


        }

        return view('home', [
            'projects' => $projects,
            'teamsAndProjects' => $teamsAndProjects
        ]);

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
