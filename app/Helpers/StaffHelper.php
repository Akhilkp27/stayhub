<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class StaffHelper
{
   public static function getStaffRoleByRoleId($roleId)
   {
      $res = DB::table('user_permissions')
         ->select('role_name')
         ->where('id', $roleId)
         ->first();

      return $res;

   }
}