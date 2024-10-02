<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Room\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function viewAddRoomType()
    {
        return view('admin.room-management.add-room-type');
    }

    public function storeRoomType(Request $request)
    {
        $roomType = $request->input('roomType');  
        $totalRooms = $request->input('totalRooms');  
        $description = $request->input('description');

        $roomTypeData = RoomType::create([
            'type_name'  => $roomType, 
            'total_rooms'  => $totalRooms,
            'available_rooms'  => $totalRooms,
            'description'  => $description,
        ]);
       
        return response()->json(['success' => true, 'message' => 'Room type saved successfully.']);
    }

    public function getRoomType(Request $request)
    {
        $roomTypes = RoomType::all();
        return response()->json($roomTypes);
    }

    public function checkRoomTypeExists(Request $request)
    {
        $roomType = $request->input('roomTypes');
        $roomTypeExists = RoomType::where('type_name', $roomType)->exists();
        return response()->json(['exists' => $roomTypeExists]);
    }

    public function getRoomTypeForEdit(Request $request)
    {
        $roomTypeId = $request->input('roomTypeId');
        $data = RoomType::where('id', $roomTypeId )->first();
        return response()->json(['data' => $data]);
    }
    public function updateRoomType(Request $request)
    {
        $roomTypeId = $request->input('roomTypeId');
        dd($roomTypeId);
    }
}
