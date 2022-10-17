<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsUserMeta extends Model
{
    use HasFactory;

    protected $table = 'team_users_meta';

    protected $fillable = [
        'team_id',
        'user_id'
    ];

    public function getUsers(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function getTeams(){
        return $this->hasMany(Teams::class, 'id', 'team_id');
    }

    public function getProjects(){
        return $this->hasManyThrough(
            Projects::class,
            TeamsProjectsMeta::class,
            'id',
            'project_id'
        );
    }




}
