<?php

namespace App\Models\Admin\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomStatus extends Model
{
    use HasFactory;
    protected $table = 'room_statuses';
    protected $fillable = [
        'status_name','description',
    ];
}
