<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsProjectsMeta extends Model
{
    use HasFactory;

    protected $table = "team_project_meta";

    protected $fillable = [
        "team_id",
        "project_id"
    ];

    public function getProjects(){
        return $this->hasMany(Projects::class, 'id', 'project_id');
    }
}
