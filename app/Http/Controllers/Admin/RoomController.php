<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Room\Amenity;
use App\Models\Admin\Room\RoomStatus;
use App\Models\Admin\Room\RoomType;
use Illuminate\Http\Request;
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

        $roomTypeData = RoomType::create([
            'type_name'  => $roomType, 
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
        $update = RoomType::where('id',$roomTypeId)
                ->update([
                    'type_name'  => $roomType, 
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
        // dd($request->all());
        return response()->json(['success' => true, 'message' => 'Status details updated.']);
    }
}
