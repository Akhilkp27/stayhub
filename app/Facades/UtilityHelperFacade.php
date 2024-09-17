<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UtilityHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UtilityHelper';
    }
}