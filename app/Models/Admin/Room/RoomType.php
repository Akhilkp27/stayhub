<?php

namespace App\Models\Admin\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'room_types';
    protected $fillable = [
        'type_name', 'total_rooms', 'available_rooms', 'description',
    ];
}
