<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\Room\Amenity;
use App\Models\Admin\Room\Room;
use App\Models\Admin\Room\RoomStatus;
use App\Models\Admin\Room\RoomStatusHistory;
use App\Models\Admin\Room\RoomStatusUpdate;
use App\Models\Admin\Room\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

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
        $prefix = $request->input('prefix');

        $roomTypeData = RoomType::create([
            'type_name'  => $roomType, 
            'prefix' => $prefix,
            'total_rooms'  => $totalRooms,
            'available_rooms'  => $totalRooms,
            'description'  => $description,
        ]);
       
        return response()->json(['success' => true, 'message' => 'Room type saved successfully.']);
    }
  
    public function checkIfExists(Request $request)
    {
        $table = $request->input('table');
        $column = $request->input('column');
        $value = $request->input('value');
    
        if (!Schema::hasTable($table)) {
            return response()->json(['error' => 'Table does not exist'], 400);
        }
    
        if (!Schema::hasColumn($table, $column)) {
            return response()->json(['error' => 'Column does not exist'], 400);
        }
    
        $exists = DB::table($table)->where($column, $value)->exists();
    
        return response()->json(['exists' => $exists]);
    }
    public function getDataForEdit(Request $request)
    {
        $table = $request->input('table');
        $id = $request->input('value');
    
        if (!Schema::hasTable($table)) {
            return response()->json(['error' => 'Table does not exist'], 400);
        }
    
        $data = DB::table($table)->where('id', $id)->first();
    
        return response()->json(['data' => $data]);
    }
    public function getTableData(Request $request)
    {
        $table = $request->input('table'); 

        $tableData = DB::table($table)->orderBy('created_at', 'desc')->get();
        
        if ($table === 'rooms') {
            foreach ($tableData as $room) {
                $room->room_status = CommonHelper::getRoomStatusByStatusId($room->current_status_id);
                $room->room_type = CommonHelper::getRoomTypeByRoomTypeId($room->room_type_id);
            }
        }
    
        return response()->json($tableData);
    }
    public function updateRoomType(Request $request)
    {
        $roomTypeId = $request->input('roomTypeId');
        $roomType = $request->input('roomType');  
        $totalRooms = $request->input('totalRooms');  
        $availableRooms = $request->input('availableRooms');
        $description = $request->input('description');
        $status = $request->input('roomTypeStatus');
        $prefix = $request->input('prefix');

        $update = RoomType::where('id',$roomTypeId)
                ->update([
                    'type_name'  => $roomType, 
                    'prefix' => $prefix,
                    'total_rooms'  => $totalRooms,
                    'available_rooms'  => $totalRooms,
                    'description'  => $description,
                    'status'  => $status,
                ]);

        return response()->json(['success' => true, 'message' => 'Room type details updated.']);
    }
    public function deleteRoomType($id)
    {
        $roomType = RoomType::find($id);
        if (!$roomType) {
            return response()->json(['success' => false, 'message' => 'Room Type not found'], 404);
        }
    
        $deleted = $roomType->delete();
    
        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Room Type deleted successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete Room Type'], 500);
        }
    }
    public function getTotalRoom(Request $request)
    {
        $totalRooms = $request->input('value');
        $roomTypeId = $request->input('id');

        $existingRoomCount = Room:: where('room_type_id',$roomTypeId)->count();

        if ($existingRoomCount >= $totalRooms ) {
        return response()->json([ 'success' => false, 'message' => 'Cannot reduce total rooms below the number of existing rooms ('.$existingRoomCount.')' ], 400);// 400 Bad Request
       }
    }

    public function viewRoomAmenities()
    {
        return view('admin.room-management.add-amenities');
    }
    public function storeAmenity(Request $request)
    {  
        try {
            // Validate the incoming request data
            $request->validate([
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional icon validation
            ]);

            $imagePath = null;

            
            if ($request->hasFile('icon')) {
                $image = $request->file('icon');
                $imagePath = $image->store('amenity_images', 'public'); 
            }

            
            $amenityName = $request->input('amenityName');
            $description = $request->input('description');

            
            $amenity = Amenity::create([
                'name' => $amenityName,
                'description' => $description,
                'image_url' => $imagePath 
            ]);

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Amenity saved successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save amenity: ' . $e->getMessage()], 500);
        }
    }
    public function updateAmenity(Request $request)
    {
        $amenityId = $request->input('amenityId');
        $amenityName = $request->input('amenityName');
        $description = $request->input('description');
        $previousImage = $request->input('existing_image');
        $imagePath = null;
    
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $imagePath = $image->store('amenity_images', 'public'); 
        } else{
            $imagePath = $previousImage;
        }

        $update = Amenity::where('id', $amenityId)
                            ->update([
                                'name' => $amenityName,
                                'description' => $description,
                                'image_url' => $imagePath 
                            ]);
        return response()->json(['success' => true, 'message' => 'Amenity details updated.']);                     
    }
    public function viewAddRoomStatus()
    {
        return view('admin.room-management.add-room-status');
    }
    public function storeRoomStatus(Request $request)
    {
        $status = $request->input('status');
        $description = $request->input('description');
        
        $data = RoomStatus::create([
            'status_name' =>$status,
            'description' =>$description
        ]);
        
        return response()->json(['success' => true, 'message' => 'Room status saved successfully.']);
        
    }
    public function updateStatus(Request $request)
    {
        $roomStatusId = $request->input('roomStatusId');
        $statusName = $request->input('status');
        $description = $request->input('description');

        $update = RoomStatus::where('id', $roomStatusId)
                            ->update([
                                'status_name' =>$statusName,
                                'description' =>$description
                            ]);
        
        return response()->json(['success' => true, 'message' => 'Status details updated.']);
    }

    public function viewRoomList()
    {
        $roomType = RoomType::all();
        return view('admin.room-management.add-room',compact('roomType'));
    }
    public function getRoomData(Request $request)
    {
        $table = $request->input('table'); 
        $selectedRoomType = $request->input('value');
        $roomType = RoomType::find($selectedRoomType); 
        $existingRoomCount = Room::where('room_type_id', $selectedRoomType)->count();

        if($existingRoomCount >= $roomType->total_rooms){
            
            return response()->json([ 'success' => false, 'message' => 'Room limit reached for this room type. You cannot create more than ' . $roomType->total_rooms . ' rooms.' ], 400);
        }

        $nextRoomCount = $existingRoomCount + 1;
        $roomNumber = $roomType->prefix . '-' . str_pad($nextRoomCount, 3, '0', STR_PAD_LEFT);
        $tableData = DB::table($table)->where('id',$selectedRoomType)->first();

        return response()->json(['roomNumber' => $roomNumber,'tableData' => $tableData]);
    }
    public function storeRoom(Request $request)
    { 
        try{
            $priceString = $request->input('pricePerNight');
            $cleanedPrice = str_replace(['₹', ','], '', $priceString);
            $roomType = RoomType::find($request->input('roomType'));

            // Count the existing rooms of this type
            $existingRoomsCount = Room::where('room_type_id', $roomType->id)->count();
    
            // Check if the current count has reached the total room limit
            if ($existingRoomsCount >= $roomType->total_rooms) {
                return response()->json(['success' => false, 'message' => 'Room limit reached for this room type. You cannot create more than.' .$roomType->total_rooms . ' rooms.'], 400);
            }
            
            $roomData = new Room();
            $roomData->room_number = $request->input('roomNumber');
            $roomData->room_type_id = $request->input('roomType');
            $roomData->price_per_night = $cleanedPrice;
            $roomData->availability = config('constants.room.AVAILABLE');
            $roomData->current_status_id = '1';
            $roomData->max_adults = $request->input('maximumAdult');
            $roomData->max_children = $request->input('maximumChild');
            $roomData->save();
            
            return response()->json(['success' => true, 'message' => 'Room saved successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save room: ' . $e->getMessage()], 500);
        }
        
    }
    public function getDataForEditRoom(Request $request)
    {
        $roomId = $request->input('value');

        $roomData = DB::table('rooms as rm')
                        ->leftJoin('room_types as rt','rm.room_type_id','=','rt.id' )
                        ->select('rm.*','rt.*','rm.id as room_id')
                        ->where('rm.id', $roomId)
                        ->first();
        return response()->json(['data' => $roomData]);                
    }
    public function updateRoom(Request $request)
    {
        $roomId = $request->input('roomId');
        $priceString = $request->input('pricePerNight');
        $cleanedPrice = str_replace(['₹', ','], '', $priceString);

        $update = Room::where('id', $roomId)
                            ->update([
                                'room_number' => $request->input('roomNumber'),
                                'room_type_id' => $request->input('roomType'),
                                'price_per_night' => $cleanedPrice,
                                'max_adults' => $request->input('maximumAdult'),
                                'max_children' => $request->input('maximumChild'),
                            ]);
        
        return response()->json(['success' => true, 'message' => 'Room details updated.']);
    }
    public function viewRoomStatus()
    {
        $roomStatus = RoomStatus::all();
        return view('admin.room-management.room-status-update',compact('roomStatus'));
    }
    public function updateRoomStatus(Request $request)
    {
        $roomId = $request->input('roomId');
        $selectedStatus = $request->input('statusSelect');
        
        $update = Room::where('id', $roomId)->update([ 'current_status_id' => $selectedStatus]);
        if (Auth::guard('admin')->check()) {
            // Admin is updating the status
            RoomStatusHistory::create([
                'room_id' => $roomId,
                'status_id' => $selectedStatus,
                'updated_by_admin' => Auth::guard('admin')->id(),
            ]);
        } elseif (Auth::guard('staff')->check()) {
            // Staff is updating the status
            RoomStatusHistory::create([
                'room_id' => $roomId,
                'status' => $selectedStatus,
                'updated_by_staff' => Auth::guard('staff')->id(),
            ]);
        }
        
        return response()->json(['success' => true, 'message' => 'Room status updated.']);
        
    }

    public function getRoomStatusUpdateHistory()
    {
        return view('admin.room-management.room-status-history');
    }
    public function getUpdateHistory(Request $request)
    {
        // $data = DB::table('rooms as rm')
        // ->leftJoin('room_status_history as rsh', 'rsh.room_id', '=', 'rm.id')
    }
}
