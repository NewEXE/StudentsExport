<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 30.03.18
 * Time: 23:59
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CSV extends Facade
{
    protected static function getFacadeAccessor() { return 'csv'; }
}