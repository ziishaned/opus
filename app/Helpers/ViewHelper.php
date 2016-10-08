<?php 

namespace App\Helpers;

use Route;

class ViewHelper
{
	public static function getCurrentRoute()
	{
		return Route::getCurrentRoute()->getPath();
	}
}