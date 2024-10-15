<?php

namespace App\Helpers;

use App\Models\Admin\Room\RoomStatus;
use App\Models\Admin\Room\RoomType;
use Illuminate\Support\Facades\DB;

class CommonHelper
{
   public static function getRoomStatusByStatusId($statusId)
   {
      $res = RoomStatus::select('status_name')
                        ->where('id', $statusId)
                        ->first();
      return $res;

   }
   public static function getRoomTypeByRoomTypeId($roomTypeId)
   {
      $re = RoomType::select('type_name')
         ->where('id', $roomTypeId)
         ->first();
         
      return $re;
   }
}