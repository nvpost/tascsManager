<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TascsFiles extends Model
{
    use HasFactory;

    public $table = "tascs_files";

    public $timestamps = false;

    public $fillable =[
        'tasc_id',
        'link',
        'type'
    ];


}
