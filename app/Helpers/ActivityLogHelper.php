<?php 

namespace App\Helpers;

use Auth;
use App\Models\Wiki;
use App\Models\Comment;
use App\Models\WikiPage;
use App\Models\Organization;

class ActivityLogHelper
{
    public static function createComment($page, $comment)
    {
        activity()
            ->useLog('created_comment')
            ->performedOn((new Comment))
            ->causedBy(Auth::user()->id)
            ->withProperties(['log_type' => 'commented', 'page_slug' => $page->slug, 'wiki_slug' => $page->wiki->slug, 'page' => $page->name, 'wiki' => $page->wiki->name, 'user_slug' => Auth::user()->slug, 'comment' => $comment])
            ->log('<a href="/users/:properties.user_slug">:causer.name</a> :properties.log_type on <a href="/wikis/:properties.wiki_slug/pages/:properties.page_slug">:properties.page</a> at <a href="/wikis/:properties.wiki_slug">:properties.wiki</a>.');
        return true;
    }

    public static function likeComment($id)
    {
        $comment = (new Comment)->where('id', '=', $id)->first();
        $page = (new WikiPage)->getPage($comment->page_id);
        $wiki = (new Wiki)->getWiki($page->wiki_id);

        activity()
            ->useLog('star_comment')
            ->performedOn((new Comment))
            ->causedBy(Auth::user()->id)
            ->withProperties(['log_type' => 'like comment', 'page_slug' => $page->slug, 'wiki_slug' => $wiki->slug, 'page' => $page->name, 'wiki' => $wiki->name, 'user_slug' => Auth::user()->slug])
            ->log('<a href="/users/:properties.user_slug">:causer.name</a> :properties.log_type on <a href="/wikis/:properties.wiki_slug/pages/:properties.page_slug">:properties.page</a> at <a href="/wikis/:properties.wiki_slug">:properties.wiki</a>.');
        return true;
    }

    public static function createOrganization($organization)
    {
        activity()
            ->useLog('created_organization')
            ->performedOn((new Organization))
            ->causedBy(Auth::user()->id)
            ->withProperties(['log_type' => 'created organization', 'organization_slug' => $organization->slug, 'organization_name' => $organization->name, 'user_slug' => Auth::user()->slug])
            ->log('<a href="/users/:properties.user_slug">:causer.name</a> :properties.log_type <a href="/organizations/:properties.organization_slug">:properties.organization_name</a>.');
        return true;   
    }

    public static function createWiki($wiki)
    {
        if(!empty($wiki->organization_id)) {
            $organization  = (new Organization)->where('id', '=', $wiki->organization_id)->first();
            activity()
                ->useLog('created_wiki')
                ->performedOn((new Wiki))
                ->causedBy(Auth::user()->id)
                ->withProperties(['log_type' => 'created wiki', 'organization_slug' => $organization->slug, 'organization_name' => $organization->name, 'wiki_slug' => $wiki->slug, 'wiki_name' => $wiki->name, 'user_slug' => Auth::user()->slug])
                ->log('<a href="/users/:properties.user_slug">:causer.name</a> :properties.log_type <a href="/wikis/:properties.wiki_slug">:properties.wiki_name</a> at <a href="/organizations/:properties.organization_slug">:properties.organization_name</a>.');
            return true;   
        }
        activity()
            ->useLog('created_wiki')
            ->performedOn((new Wiki))
            ->causedBy(Auth::user()->id)
            ->withProperties(['log_type' => 'created wiki', 'wiki_slug' => $wiki->slug, 'wiki_name' => $wiki->name, 'user_slug' => Auth::user()->slug])
            ->log('<a href="/users/:properties.user_slug">:causer.name</a> :properties.log_type <a href="/wikis/:properties.wiki_slug">:properties.wiki_name</a>');
        return true;   
    }

    public static function createWikiPage($page)
    {
        $wiki  = (new Wiki)->where('id', '=', $page->wiki_id)->first();
        activity()
            ->useLog('created_wiki_page')
            ->performedOn((new WikiPage))
            ->causedBy(Auth::user()->id)
            ->withProperties(['log_type' => 'created wiki page', 'wiki_slug' => $wiki->slug, 'wiki_name' => $wiki->name, 'page_slug' => $page->slug, 'page_name' => $page->name, 'user_slug' => Auth::user()->slug])
            ->log('<a href="/users/:properties.user_slug">:causer.name</a> :properties.log_type <a href="/wikis/:properties.wiki_slug/pages/:properties.page_slug">:properties.page_name</a> at <a href="/wikis/:properties.wiki_slug">:properties.wiki_name</a>.');
        return true;
    }
}