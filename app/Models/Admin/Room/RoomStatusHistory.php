<?php

namespace App\Models\Admin\Room;

use App\Models\Admin;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomStatusHistory extends Model
{
    use HasFactory;
    protected $table = 'room_status_history';
    protected $fillable = [
        'room_id','status_id','updated_by_admin','updated_by_staff',
    ];

    public function updatedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'updated_by_admin');
    }
    
    public function updatedByStaff()
    {
        return $this->belongsTo(Staff::class, 'updated_by_staff');
    }
}
