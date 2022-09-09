<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tascs_canban_meta extends Model
{
    use HasFactory;

    public $table = 'tascs_canban_meta';

    public $fillable = [
        'tasc_id',
        'board_id'
    ];

    public function tascable(){
        return $this->morphMany();
    }


    public function tascs(){
        return $this->hasOne(Tascs::class,'id', 'tasc_id');
    }
}
