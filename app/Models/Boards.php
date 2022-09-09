<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boards extends Model
{
    use HasFactory;

    public $fillable=[
        'canban_id',
        'user_id',
        'name',
        'description',
        'position',
    ];

    public function tascs(){
        return $this->morphMany(tascs_canban_meta::class, 'tascable');
    }

    public function tascs_canban_meta(){
        return $this->hasMany(tascs_canban_meta::class,'board_id', 'id');
    }

}
