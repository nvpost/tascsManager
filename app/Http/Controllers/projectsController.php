<?php

namespace App\Http\Controllers;

use App\Models\Canbans;
use App\Models\Projects;
use App\Models\Statuses;
use App\Models\Tascs;
use App\Models\TascsFiles;
use App\Models\TeamsProjectsMeta;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class projectsController extends Controller
{
    public function projects(){
        $projects = Projects::with(['Tascs'])->where(['user_id'=>Auth::user()->id])->get();
        return view('content.projects', [
            'projects' => $projects
        ]);
    }

    public function showProject($id){

        $project = Projects::where(['id'=> $id])->firstOrFail();
        $tascs = Tascs::with(['statuses', 'tascFiles'])->where('project_id', $id)->get();
        $stats = Statuses::whereIn('whose', ['tp', 't'])->get();

//        dd($project);
        return view('content.project', [
            'project' => $project,
            'tascs' => $tascs,
            'stats' => $stats
        ]);
    }

    public function projects_add(){
        return view('content.projects_add');
    }

    public function projects_save(Request $req){


        $user_id =Auth::user()->id;
        $valid = $req->validate([
            'label'=>'required|min:2',
            'description'=>'required',
            'start_date'=>'required|min:2',
            'finish_date'=>'required|min:2',
        ]);


        $start_date = new Carbon($valid['start_date']);
        $finish_date = new Carbon($valid['finish_date']);


        $project = new Projects();
        $project::create([
            'user_id'=>$user_id,
            'label'=>$valid['label'],
            'description'=>$valid['description'],
            'start_date'=>$start_date,
            'finish_date'=>$finish_date
        ]);

        return redirect(route('user.projects'));

    }

    public function removeProject_getInfo(Request $req){

        $project = Projects::with(['Tascs', 'Tascs.tascFiles', 'getTeamMeta', 'getCanbansMeta'])
            ->where(['id'=>$req->get('id'), 'user_id'=>Auth::user()->id])
            ->firstOrFail();

        return ['project'=>$project, 'creator_id'=>$project->user_id];
    }

    public function remove_project(Request $req){

        $project_id = $req->get('project_id');
        $project = Projects::with(['Tascs', 'Tascs.tascFiles', 'getTeamMeta', 'getCanbansMeta'])
            ->where(['id'=>$project_id, 'user_id'=>Auth::user()->id])
            ->firstOrFail();

        $tascs = $project->tascs();


        //???????????????????? ?????? ??????????
        $files_arr = [];
        Storage::disk('local')->put('example.txt', 'Contents');
        foreach ($tascs->get() as $t){

            $dirname = "upl_files/tascs/".$t->id;
            if(is_dir( $dirname )){
                if(count(glob("$dirname/*.*"))>0){
                    array_map('unlink', glob("$dirname/*.*"));
                }

                rmdir($dirname);
            }

            TascsFiles::where(['tasc_id'=>$t->id])->delete();
        }

        $tascs->delete();




        //TeamMeta
        TeamsProjectsMeta::where(['project_id'=>$project_id])->delete();
        //CanbanMeta
        Canbans::where(['project_id'=>$project_id])->delete();

        //fileLink



        $project->delete();



        return redirect(route('user.projects'));
    }
}
