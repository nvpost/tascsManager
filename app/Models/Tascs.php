<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tascs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'label',
        'description',
        'status',
    ];

    public function statuses(){
        return $this->HasOne(Statuses::class, 'id', 'status');

    }
    public function tascFiles(){
        return $this->HasMany(TascsFiles::class, 'tasc_id', 'id');

    }

    public function MatrixMeta(){
        return $this->hasOne(MatrixMeta::class, 'tasc_id', 'id');
    }

    public function tascs_canban_meta(){
        return $this->hasOne(tascs_canban_meta::class, 'tasc_id', 'id');
    }

}
