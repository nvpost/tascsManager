<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canbans extends Model
{
    use HasFactory;


    public $fillable = [
        'project_id',
        'user_id',
        'name',
        'description',
    ];


    public function Boards(){
        return $this->hasMany(Boards::class, 'canban_id', 'id');
    }

}
