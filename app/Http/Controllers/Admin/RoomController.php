<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function viewAddRoomType()
    {
        return view('admin.room-management.add-room-type');
    }
}
