<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrixMeta extends Model
{
    use HasFactory;

    public $table = "tascs_matrix_meta";

    public $fillable = [
        'tasc_id',
        'matrix_id'
    ];
}
