<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CanbanController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MatrixController;
use App\Http\Controllers\PrivateController;
use App\Http\Controllers\projectsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\tascsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\UserTeamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'home'])->name('home');



Route::name('user.')->group(function (){
    Route::get('private', [PrivateController::class, 'content'])->middleware('auth')->name('private');

    Route::get('login', function (){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('user/login');
    })->name('login');

    Route::get('/registration', function(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('user/registration');
    })->name('registration');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/registration', [UserController::class, 'saveNewUser']);
});

//Закрыть всю группу




Route::post('add_role', [RolesController ::class, 'add_role'])->name('add_role');
Route::post('set_role', [RolesController ::class, 'set_role'])->name('set_role');


Route::get('/project/{id}', [projectsController::class, 'showProject'])->name('showProject');


Route::group(['as'=>'admin.', 'middleware' => ['isAdmin'] ], function(){
    Route::get('users', [usersController ::class, 'showUsers'])->name('users');
    Route::get('roles', [RolesController ::class, 'roles'])->name('roles');


    Route::post('edit_role', [RolesController ::class, 'edit_role'])->name('edit_role');
    Route::post('add_role', [RolesController ::class, 'add_role'])->name('add_role');
    Route::post('delete_role', [RolesController ::class, 'delete_role'])->name('delete_role');
});

Route::group(['as'=>'user.', 'middleware' => ['auth']], function(){

    Route::get('/projects', [projectsController::class, 'projects'])->name('projects');

    Route::post('/get_tasc_data', [tascsController::class, 'getTascData'])->name('getTascData');
    Route::get('/projects_add', [projectsController::class, 'projects_add'])->name('projects_add');

    Route::post('/projects_save', [projectsController::class, 'projects_save'])->name('projects_save');

    Route::post('/project/removeProject_getInfo', [projectsController::class, 'removeProject_getInfo'])->name('removeProject_getInfo');

    Route::get('/tascs', [tascsController::class, 'tascs'])->name('tascs');
    Route::post('/tasc_add', [tascsController::class, 'tasc_add'])->name('tasc_add');
    Route::post('/tascs/edit_tasc', [tascsController::class, 'edit_tasc'])->name('edit_tasc');
    Route::post('/tascs/del_tasc_file', [tascsController::class, 'del_tasc_file'])->name('del_tasc_file');

    Route::get('/matrix/{id?}', [MatrixController::class, 'showMatrix'])->name('matrix');
    Route::post('/matrix', [MatrixController::class, 'setMatrixStatus'])->name('setMatrixStatus');

    Route::get('/canban/{id?}', [CanbanController::class, 'showCanban'])->name('canban');
    Route::post('/canban', [CanbanController::class, 'canban_add'])->name('canban_add');
    Route::post('/canban/add_board', [CanbanController::class, 'board_add'])->name('board_add');
    Route::post('/canban/change_board', [CanbanController::class, 'setCanbanStatus'])->name('setCanbanStatus');
    Route::post('/canban/delete_board', [CanbanController::class, 'deleteBoard'])->name('deleteBoard');
    Route::post('/canban/change_position', [CanbanController::class, 'changePosition'])->name('changePosition');


    Route::get('/teams', [UserTeamController::class, 'teams'])->name('teams');
    Route::get('/team/{id}', [UserTeamController::class, 'team_item'])->name('team_item');
    Route::post('/team/member_add', [UserTeamController::class, 'member_add'])->name('member_add');
    Route::post('/team/add_team', [UserTeamController::class, 'add_team'])->name('add_team');
    Route::post('/team', [UserTeamController::class, 'editTeamInfo'])->name('editTeamInfo');
    Route::post('/team/add_user', [UserTeamController::class, 'team_user_add'])->name('team_user_add');
    Route::post('/team/pinToTeam', [UserTeamController::class, 'pinToTeam'])->name('pinToTeam');
    Route::post('/team/TeamRemoveUser', [UserTeamController::class, 'TeamRemoveUser'])->name('TeamRemoveUser');
    Route::post('/team/removeTeam', [UserTeamController::class, 'removeTeam'])->name('removeTeam');
    Route::post('/team/selfRemoveUser', [UserTeamController::class, 'selfRemoveUser'])->name('selfRemoveUser');
});



//Route::get('/user/{id}/{n}', function ($id, $n) {
//    return "ID: ".$id ."<br>Name: ".$n;
//});
