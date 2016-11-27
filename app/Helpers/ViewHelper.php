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

    public static function userHasOrganization($organizationSlug)
    {
        $organization = (new Organization)->getOrganization($organizationSlug);
        $userHasOrganization =  DB::table('user_organization')->where([
            'user_id' => Auth::user()->id,
            'organization_id' => $organization->id,
        ])->first();

        if($userHasOrganization) {
            return true;
        }
        return false;
    }

    public static function getUsername($id)
    {
        return User::where('id', '=', $id)->pluck('name')->first();
    }

    public static function getUserSlug($id)
    {
        return User::where('id', '=', $id)->pluck('slug')->first();
    }

    public static function getWikiSlug($id)
    {
        return Wiki::where('id', '=', $id)->pluck('slug')->first();
    }

    public static function getPageSlug($id)
    {
        return WikiPage::where('id', '=', $id)->pluck('slug')->first();
    }

    public static function getOrganizationName($id)
    {
        return Organization::where('id', '=', $id)->pluck('name')->first();
    }

    public static function getWikiName($id)
    {
        return Wiki::where('id', '=', $id)->pluck('name')->first();
    }

    public static function isFollowing($id)
    {
        $userFollow = DB::table('user_followers')->where('user_id', '=', Auth::user()->id)->where('follow_id', '=', $id)->first();

        if($userFollow) {
            return true;
        }
        return false;
    }

    public static function makeWikiPageTree($wikiPages, $currentPageId)
    {
        foreach ($wikiPages as $page => $value) {
            $class = '';
            if($value->id == $currentPageId) {
                $class='active';
            }

            echo  '<li class="'.$class.'" id="'.$value->id.'"><a href="/wikis/'. $value->wiki->slug .'/pages/'. $value->slug . '">' . $value->name . '</a>';
            if(!empty($value['pages'])) {
                echo '<ul>';
                self::makeWikiPageTree($value['pages'], $currentPageId);
                echo '</ul></li>';
            }
        }
    }

    public static function getWiki($slug)
    {
        return Wiki::where('slug', '=', $slug)->where('user_id', '=', Auth::user()->id)->first();
    }

    public static function getCommentStar($id)
    {
        return DB::table('user_star')->where('entity_type', '=', 'comment')->where('entity_id', '=', $id)->groupBy('entity_id')->count();
    }

    public static function getWikiStar($id)
    {
        return DB::table('user_star')->where('entity_type', '=', 'wiki')->where('entity_id', '=', $id)->groupBy('entity_id')->count();
    }

    public static function getPageStar($id)
    {
        return DB::table('user_star')->where('entity_type', '=', 'page')->where('entity_id', '=', $id)->groupBy('entity_id')->count();
    }

    public static function getWikiWatch($id)
    {
        return DB::table('user_watch')->where('entity_type', '=', 'wiki')->where('entity_id', '=', $id)->groupBy('entity_id')->count();
    }

    public static function getPageWatch($id)
    {
        return DB::table('user_watch')->where('entity_type', '=', 'page')->where('entity_id', '=', $id)->groupBy('entity_id')->count();
    }
}