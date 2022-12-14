<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Roles;
use App\Models\Teams;
use App\Models\TeamsProjectsMeta;
use App\Models\TeamsUserMeta;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class UserTeamController extends Controller
{
    public function teams(){
        $user_id = Auth::user()->id;
        $teams = Teams::with(['getUsersMeta', 'getUsersMeta.getUsers', 'getTeamMeta', 'getCreator'])
            ->where(['creator_id' => $user_id])
            ->orWhereHas('getUsersMeta', function(Builder $q) use ($user_id){
                $q->where('user_id', '=', $user_id);
            })
            ->get()
            ->toArray();

        return view('team.teams_page', [
            'teams' => $teams,

        ]);
    }

    public function add_team(Request $req){

        if(!Auth::user()){
            abort(403);
        }

        $valid = $req->validate([
            'name'=>'required',
        ]);


        Teams::create([
            'creator_id' => Auth::user()->id,
            'name'=>$req->get('name'),
            'description'=>$req->get('description'),
        ]);

        return redirect()->route('user.teams');

    }

    protected function getTeamData(){

    }

    protected function canGetData($id){
        if(!Auth::user()){
            abort(403);
        }
        $team = Teams::with(['getUsersMeta'])->where(['id' => $id])->first();

        $sub_user_flag = true;
        if(count($team['getUsersMeta'])>0){
            $sub_users = $team['getUsersMeta'];

            foreach ($sub_users as $s){
                if($s['user_id'] == Auth::user()->id){
                    $sub_user_flag = false;
                }
            }
        }

        if(Auth::user()->id != $team['creator_id'] && $sub_user_flag){
            dd(Auth::user()->id != $team['creator_id'] || !$sub_user_flag);
            abort(403);
        }

        return $team;
    }

    public function team_item($id){
        //???????????????? ?????????? ?? teams_meta

        $projects = Projects::with(['Tascs', 'getTeamMeta'])
            ->WhereHas('getTeamMeta', function(Builder $q) use ($id){
                $q->where('team_id', '=', $id);
            })
            ->get()
            ->toArray();

        $all_projects = Projects::with(['Tascs', 'getTeamMeta'])
            ->where(['user_id'=>Auth::user()->id])
            ->get()
            ->toArray();
        //dd($projects);

        $team = $this->canGetData($id);


        $users = TeamsUserMeta::with('getUsers')
            ->where(['team_id'=>$id])
            ->get()
            ->toArray();

//        dd($users);

        return view('team.team_item', [
            'team' => $team,
            'users' => $users,
            'projects' => $projects,
            'all_projects' => $all_projects
        ]);
    }

    public function editTeamInfo(Request $req){
        $id = $req->get('id');
        $team = $this->canGetData($id);

        $team['description'] = $req->get('description');
        $team['name'] = $req->get('name');
        $team->save();
// ???????????????????? ???? ???????????????????? url

        return Redirect::to(route('user.team_item', ['id' => $id]));


    }

    public function team_user_add(Request $req){
        $id=$req->get('id');
        $team = $this->canGetData($id);

        $email = $req->get('email');
        $user = User::select('id', 'email')->where(['email' => $email ])->first();

        if(!$user){
            return redirect(route('user.team_item', ['id' => $id]))->withErrors([
                'formError' => '???????????????????????? ?? email '.$email.' ???? ????????????????????. ?????????? ?????????????? ????????????????????????????????'
            ]);
        }
        //team_user_meta
        $tum = TeamsUserMeta::where(['user_id' => $user['id'], 'team_id'=>$team['id']])->first();
        if($tum){
            return redirect(route('user.team_item', ['id' => $id]))->withErrors([
                'formError' => '???????????????????????? ?? email '.$email.' ?????? ?? ??????????????'
            ]);
        }
        TeamsUserMeta::create([
            "team_id" => $team['id'],
            "user_id" => $user['id']
        ]);

        return Redirect::to(route('user.team_item', ['id' => $id]));

    }

    public function pinToTeam(Request $req){
        $team_id=$req->get('team_id');
        $team = $this->canGetData($team_id);
        $project_id = $req->get('project_id');

//       team_project_meta
        $tpm = TeamsProjectsMeta::where(['team_id' => $team_id, 'project_id'=>$project_id]);
        if($tpm->first()){
            $tpm->delete();
            return ['res'=>'noOk'];

        }

        TeamsProjectsMeta::create([
            'team_id' => $team_id,
            'project_id'=>$project_id
        ]);

        return ['res'=>'ok'];
    }

    public function TeamRemoveUser(Request $req){
        $team_id=$req->get('team_id');
        $team = $this->canGetData($team_id);

        $user_id=$req->get('user_id');

        TeamsUserMeta::where(['user_id' => $user_id, 'team_id'=>$team['id']])->delete();

        return ['res'=>'ok'];
    }

    public function removeTeam(Request $req){

        $team_id=$req->get('id');
        $team = $this->canGetData($team_id);

        $usersMeta = TeamsUserMeta::where(['team_id'=>$team->id]);
        $projectsMeta = TeamsProjectsMeta::where(['team_id'=>$team->id]);

        $usersMeta->delete();
        $projectsMeta->delete();

        $team->delete();

        return ['res'=>'ok'];
    }

    public function selfRemoveUser(Request $req){

//        $user_id
        $team_id = $req->get('team_id');
        $usersMeta = TeamsUserMeta::where(['team_id'=>$team_id, 'user_id'=>Auth::user()->id]);
        $usersMeta->delete();
        return ['res'=>'ok'];


    }


}
