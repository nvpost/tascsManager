<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class usersController extends Controller
{
    public function showUsers(){

        if(!Gate::any(['isSuperAdmin', 'isAdmin'], 4)){
            abort(403);
        }
        $user = new User();
        $roles = Roles::all();
        $user_and_roles = $user::with('user_admin_roles');

        return view('admin.users', [
            'users' => $user->all(),
            'roles' => $roles,
            'user_and_roles' => $user_and_roles->get()
        ]);
    }
}
