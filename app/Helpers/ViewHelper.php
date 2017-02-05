<?php 

namespace App\Helpers;

use Route;
use App\Models\User;
use App\Models\Wiki;
use App\Models\WikiPage;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewHelper
{
	public static function getCurrentRoute()
	{
		return Route::getCurrentRoute()->getPath();
	}

    public static function getBackgroundColor($name)
    {
        $colors = [
            'rgb(181, 158, 140)',
            'rgb(75, 147, 209)',
            'rgb(147, 84, 202)',
            'rgb(72, 191, 131)',
            'rgb(65, 65, 65)',
            'rgb(239, 86, 79)',
            'rgb(98, 108, 120)',
            'rgb(214, 139, 79)',
            'rgb(109, 187, 62)',
        ];
        
        return $colors[array_rand($colors)];
    }
}