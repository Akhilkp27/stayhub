<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
       'user_id' ,'user_type', 'action', 'description', 'ip_address', 'user_agent'
    ];
    
}
