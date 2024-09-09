<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'user_permissions';

    // The attributes that are mass assignable.
    protected $fillable = [
        'role_name',
        'permissions',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'permissions' => 'array',
    ];
}
