<?php

namespace App\Models\Admin\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'room_number','room_type_id', 'price_per_night', 'availability', 'current_status_id', 'max_adults', 'max_children',
    ];
}
