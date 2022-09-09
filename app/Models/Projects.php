<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'description',
        'start_date',
        'finish_date',
    ];

    public function Tascs(){
        return $this->hasMany(Tascs::class, 'project_id', 'id');
    }

    public function getTeamMeta(){
        return $this->hasMany(TeamsProjectsMeta::class, 'project_id', 'id');
    }
}
