<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\UserAdminRole;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function roles(){
        $role = new Roles();
        return view('admin.roles', [
            'roles' => $role->all()

        ]);
    }
    public function add_role(Request $req){
        $role = new Roles();


        $data = $req->validate([
            "name" => "required|string|max:255",
        ]);
//        $data['ability']="ability";

        if($role::where('name', $data['name'])->exists()){
            return redirect(route('roles'))->withErrors([
                'formError' => 'Есть такая роль'
            ]);
        }

        $role::create(
            $data
        );

        return redirect(route('roles'));
    }

    public function set_role(Request $req){
        $r_id = (int)$req->get('role_id');
        $u_id = (int)$req->get('user_id');
        $ch = UserAdminRole::where(["role_id"=>$r_id, "admin_user_id"=>$u_id])->get();
        if(count($ch)>0){
            UserAdminRole::where('id', $ch[0]->id)->delete();
            return ['res'=>'такой уже есть', 'data'=>$ch[0]->id];

        }

        UserAdminRole::insert([
            "role_id" => $r_id ,
            "admin_user_id" => $u_id
        ]);

        return ['res'=>'ok', 'data'=>$req->all()];
    }

    public function edit_role(Request $req){
        $r_id = (int)$req->get('id');
        $r_value = $req->get('value');
        Roles::where(['id'=>$r_id])
            ->update(['name'=>$r_value]);

        return ['res'=>'ok', 'data'=>$req->all()];
    }

    public function delete_role(Request $req){
        $r_id = (int)$req->get('id');
        Roles::where('id', $r_id )->delete();
        return ['res'=>'ok', 'data'=>$req->all()];
    }
}
