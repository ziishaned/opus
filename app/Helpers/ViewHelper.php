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
        $letter = $name[0];
        $expressions = [ 'a|A', 'b|B', 'c|C', 'd|D', 'e|E', 'f|F', 'g|G', 'h|H', 'i|I', 'j|J', 'k|K', 'l|L', 'm|M', 'n|N', 'o|O', 'p|P', 'q|Q', 'r|R', 's|S', 't|T', 'u|U', 'v|V', 'w|W', 'x|X', 'y|Y', 'z|Z'  ];
        $colors = ['rgb(181, 158, 140)', 'rgb(75, 147, 209)', 'rgb(147, 84, 202)', 'rgb(72, 191, 131)', 'rgb(65, 65, 65)', 'rgb(239, 86, 79)', 'rgb(98, 108, 120)', 'rgb(214, 139, 79)', 'rgb(109, 187, 62)', 'rgb(255,99,71)', 'rgb(255,165,0)', 'rgb(102,205,170)', 'rgb(186,85,211)', 'rgb(210,180,140)', 'rgb(176,196,222)', 'rgb(218,112,214)', 'rgb(65,105,225)', 'rgb(30,144,255)', 'rgb(70,130,180)', 'rgb(0,139,139)', 'rgb(0,128,128)', 'rgb(46,139,87)', 'rgb(178,34,34)', 'rgb(0,139,139)', 'rgb(60,179,113)', 'rgb(72,209,204)', ];

        foreach ($expressions as $key => $expression) {
            if(preg_match('/'.$expression.'/', $letter)) {
                return $colors[$key];
            }
        }

        return 'rgb(147, 84, 202)';
    }
}