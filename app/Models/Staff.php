<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Staff extends Authenticatable
{
    use HasFactory;
    protected $table = 'staffs';
    public $timestamps = true;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'role',
        'username',
        'password',
        'address',
        'start_date',
        'salary',
        'status',
        'image_url',
    ];
    // If you want to establish a relationship with user_permissions, you can add:
    public function userPermission()
    {
        return $this->belongsTo(UserPermission::class, 'role');
    }
}
