<?php

namespace App\Http\Controllers;

use App\Models\MatrixMeta;
use App\Models\Projects;
use App\Models\Statuses;
use App\Models\Tascs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatrixController extends Controller
{
    public function showMatrix($id=false){
        if($id){
            $tascs = Tascs::with(['MatrixMeta'])->where(['user_id' => Auth::user()->id, 'project_id' => $id])->get();
        }else{
            $tascs = Tascs::with(['MatrixMeta'])->where('user_id', Auth::user()->id)->get();
        }

        $stats = Statuses::whereIn('whose', ['tp', 't'])->get();

        return view('matrix.matrix', [
            'tascs'=>$tascs,
            'projects'=>Projects::where('user_id', Auth::user()->id)->get(),
            'id'=>$id,
            'stats'=>$stats,
            'user_id'=>Auth::user()->id
        ]);
    }

    public function setMatrixStatus(Request $req){
        $row = MatrixMeta::where('tasc_id', $req->get('tasc_id'))->get();
        if(count($row)==0){
            MatrixMeta::create([
                'tasc_id' => $req->get('tasc_id'),
                'matrix_id' => $req->get('matrix_id'),
            ]);
        }else{
            MatrixMeta::where('tasc_id', $req->get('tasc_id'))
                ->update(['matrix_id' => $req->get('matrix_id')]);
        }
        return ['status'=>$req->all(), 'row' => $row];
    }

}
