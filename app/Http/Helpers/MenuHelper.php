<?php

namespace App\Http\Helpers;

use Route;

class MenuHelper
{
    /**
     * Checking is sub menu is active or not 
     * 
     * @param string $menuName
     * @return string
     */
    public static function isSubMenuActive($menuName)
    {
        return Route::currentRouteNamed($menuName) ? 'submenuActive' : ''; 
    }
}
