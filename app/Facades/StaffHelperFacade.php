<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class StaffHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'StaffHelper';
    }
}