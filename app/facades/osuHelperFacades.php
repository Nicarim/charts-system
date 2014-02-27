<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 27.02.14
 * Time: 18:12
 */

use Illuminate\Support\Facades\Facade;

class osuHelperFacades extends Facade{
    protected static function getFacadeAccessor() { return 'osuHelper'; }
} 