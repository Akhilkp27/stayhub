<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
class UtilityHelper
{
    public static function getUserDetailsById($userId, $userGuard)
    {
        switch ($userGuard) {
            case 'admin':
                return DB::table('admins')->where('id', $userId)->first(); // All details of the admin
    
            case 'staff':
                return DB::table('staffs')->where('id', $userId)->first(); // All details of the staff
    
            case 'customer':
                return DB::table('customers')->where('id', $userId)->first(); // All details of the customer
    
            default:
                throw new \Exception("Invalid user guard provided: $userGuard");
        }
    }
}