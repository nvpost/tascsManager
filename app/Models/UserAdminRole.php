<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdminRole extends Model
{
    use HasFactory;

    protected $table = 'admin_user_role';

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
