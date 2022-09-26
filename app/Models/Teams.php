<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;

    public $table = 'teams';

    public $fillable = [
        'creator_id',
        'name',
        'description',
        'status'
    ];

    public function getUsersMeta(){
        return $this->HasMany(TeamsUserMeta::class, 'team_id', 'id');

    }

    public function getTeamMeta(){
        return $this->hasMany(TeamsProjectsMeta::class, 'team_id', 'id');
    }
}
