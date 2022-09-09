<?php

namespace App\Http\Controllers;

use App\Models\MatrixMeta;
use App\Models\Tascs;
use App\Models\TascsFiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class tascsController extends Controller
{
    public function tascs(){
        return view('content.tascs');
    }

    public function tasc_add(Request $req){
        $valid = $req->validate([
            'project_id'=>'required',
            'label'=>'required'
        ]);



        $description = "";
        if($req->get('description')){
            $description = $req->get('description');
        };
        $status=1;



        $tasc_id = Tascs::create([
            'user_id' => Auth::user()->id,
            'project_id' => $valid['project_id'],
            'label' => $valid['label'],
            'description' => $description,
            'status' => $status
        ])->id;

        if($req->get('matrix')){
            MatrixMeta::create([
                'tasc_id' => $tasc_id,
                'matrix_id' => $req->get('matrix')
            ]);
        }

        if($req->hasFile('files')){
            foreach ($req->file('files') as $file){
                $this->fileUpload($file, $tasc_id);
            }
        }


        return Redirect::back();
    }

    public function fileUpload($file, $tasc_id){
        $file_name = $file->getClientOriginalName();
        $type = $file->getClientOriginalExtension();
        $path = '/upl_files/tascs/'.$tasc_id.'/';
        $file->move(public_path() . $path, $file_name);

        TascsFiles::create([
            'tasc_id' => $tasc_id,
            'link' => $path.$file_name,
            'type' => $type
        ]);

    }

    public function edit_tasc(Request $req){
//        dd($req->all());
        $carbon = new Carbon;
//        dd($carbon::createFromTimestampUTC($req->get('finish_date')));
        $tasc = Tascs::findOrFail($req->get('tasc_id'));
        $tasc->label = $req->get('label');
        $tasc->description = $req->get('description');
        $tasc->start_date = new Carbon($req->get('start_date'));
        $tasc->finish_date = new Carbon($req->get('finish_date'));
        $tasc->status = $req->get('status');

        $tasc->save();

        if($req->hasFile('files')){
            foreach ($req->file('files') as $file){
                $this->fileUpload($file, $tasc->id);
            }
        }

        return Redirect::back();


    }
    public function del_tasc_file(Request $req){
        TascsFiles::where('id', $req->get('file_id'))->delete();

        return ['res'=>'ok'];
    }


    public function getTascData(Request $req){
//        $tasc = Tascs::findOrFail($req->get('tasc_id'));

        $tasc = Tascs::with(['statuses', 'tascFiles'])->findOrFail($req->get('tasc_id'));
        $canEdit = Auth::user()->id == $tasc->user_id;
        $tasc['canEdit'] = $canEdit;


        if(Auth::user()->id != $tasc->user_id){
            return [false];
        }else{
            return $tasc;
        }
    }



}
