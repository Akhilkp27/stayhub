<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CommonHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CommonHelper';
    }
}