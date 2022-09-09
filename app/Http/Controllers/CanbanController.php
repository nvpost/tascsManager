<?php

namespace App\Http\Controllers;

use App\Models\Boards;
use App\Models\Canbans;
use App\Models\Projects;
use App\Models\Statuses;
use App\Models\Tascs;
use App\Models\tascs_canban_meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CanbanController extends Controller
{
    public function showCanban($id=false){

        $canbans = Canbans::with(['Boards', 'Boards.tascs_canban_meta', 'Boards.tascs_canban_meta.tascs'])
            ->where(['user_id' => Auth::user()->id, 'project_id' => $id])
            ->get()
            ->toArray();

        if($id){
            $tascs = Tascs::with('tascs_canban_meta')->where(
                ['user_id' => Auth::user()->id, 'project_id' => $id]
            )->doesntHave('tascs_canban_meta')
                ->get();
        }else{
            $tascs = Tascs::where('user_id', Auth::user()->id)->get();
        }

        $stats = Statuses::whereIn('whose', ['tp', 't'])->get();

        return view('canban.canban', [
            'tascs' => $tascs,
            'canbans' => $canbans,
            'projects'=>Projects::where('user_id', Auth::user()->id)->get(),
            'id' => $id,
            'stats' => $stats

        ]);
    }

    public function canban_add(Request $req){
        $project_id = $req->get('project_id');
        $req->validate([
            'name'=>'required',
        ]);
        Canbans::create([
            'project_id' => $req->get('project_id'),
            'user_id'=>Auth::user()->id,
            'name'=> $req->get('name'),
            'description'=> $req->get('description'),
        ]);
//        Redirect::back();
        return Redirect::back();
    }

    public function board_add(Request $req){
        $req->validate([
            'name'=>'required',
        ]);
//        dd($req->all());

        Boards::create([
            'canban_id'=>$req->get('canban_id'),
            'user_id'=>Auth::user()->id,
            'name'=> $req->get('name'),
            'description'=> $req->get('description'),
            'position' => $req->get('position'),
        ]);

        return Redirect::back();
    }

    public function setCanbanStatus(Request $req){
        if($req->get('board_id')==0){
            tascs_canban_meta::where('tasc_id', $req->get('tasc_id'))->delete();
            return ['status'=>$req->get('tasc_id')];
        }
        $row = tascs_canban_meta::where('tasc_id', $req->get('tasc_id'))->first();

        if(!$row){
            tascs_canban_meta::create([
                'tasc_id' => $req->get('tasc_id'),
                'board_id' => $req->get('board_id'),
            ]);
        }
        else{
            $row->board_id = (int)$req->get('board_id');
            $row->save();
        }
        return ['status'=>$req->get('board_id'), 'row' => $row];
    }

    public function deleteBoard(Request $req){
        $column = Boards::where('id', $req->get('id'))->first();
        $tasc_meta = tascs_canban_meta::where('board_id', $column->id)->get();

        if(count($tasc_meta)==0){
            $column->delete();
            return ['status'=>'delete'];
        }else{
            return ['status'=>'error', 'tm'=>$tasc_meta];
        }
    }

    public function changePosition(Request $req){

        $np = $req->get('new_positions');
//        $update_query = [];
        DB::transaction(function() use($np){
            foreach($np as $key=>$val){
                Boards::where(['id'=>(int)$val['id']])
                    ->update(['position'=>(int)$val['position']]);
            }
        });


//        $boards = Boards::whereIn('id', $boards_id)->get();
//            array_push($update_query, ['id'=>(int)$val['id'], 'position'=>(int)$val['position']]);
//            array_push($boards_id, (int)$val['id']);


        return ['status'=>'ok'];

    }

}
