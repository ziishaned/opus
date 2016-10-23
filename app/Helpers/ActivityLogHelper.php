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
            ->withProperties(['log_type' => 'commented', 'page_id' => $page->id, 'wiki_id' => $page->wiki->id, 'page' => $page->name, 'wiki' => $page->wiki->name, 'user_id' => Auth::user()->id, 'comment' => $comment])
            ->log('<a href="/users/:properties.user_id">:causer.name</a> :properties.log_type on <a href="/wikis/:properties.wiki_id/pages/:properties.page_id">:properties.page</a> at <a href="/wikis/:properties.wiki_id">:properties.wiki</a>.');
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
            ->withProperties(['log_type' => 'like comment', 'page_id' => $page->id, 'wiki_id' => $wiki->id, 'page' => $page->name, 'wiki' => $wiki->name, 'user_id' => Auth::user()->id])
            ->log('<a href="/users/:properties.user_id">:causer.name</a> :properties.log_type on <a href="/wikis/:properties.wiki_id/pages/:properties.page_id">:properties.page</a> at <a href="/wikis/:properties.wiki_id">:properties.wiki</a>.');
        return true;
    }

    public static function createOrganization($organization)
    {
        activity()
            ->useLog('created_organization')
            ->performedOn((new Organization))
            ->causedBy(Auth::user()->id)
            ->withProperties(['log_type' => 'created organization', 'organization_id' => $organization->id, 'organization_name' => $organization->name, 'user_id' => Auth::user()->id])
            ->log('<a href="/users/:properties.user_id">:causer.name</a> :properties.log_type <a href="/organizations/:properties.organization_id">:properties.organization_name</a>.');
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
                ->withProperties(['log_type' => 'created wiki', 'organization_id' => $organization->id, 'organization_name' => $organization->name, 'wiki_id' => $wiki->id, 'wiki_name' => $wiki->name, 'user_id' => Auth::user()->id])
                ->log('<a href="/users/:properties.user_id">:causer.name</a> :properties.log_type <a href="/wikis/:properties.wiki_id">:properties.wiki_name</a> at <a href="/organizations/:properties.organization_id">:properties.organization_name</a>.');
            return true;   
        }
        activity()
            ->useLog('created_wiki')
            ->performedOn((new Wiki))
            ->causedBy(Auth::user()->id)
            ->withProperties(['log_type' => 'created wiki', 'wiki_id' => $wiki->id, 'wiki_name' => $wiki->name, 'user_id' => Auth::user()->id])
            ->log('<a href="/users/:properties.user_id">:causer.name</a> :properties.log_type <a href="/wikis/:properties.wiki_id">:properties.wiki_name</a>');
        return true;   
    }

    public static function createWikiPage($page)
    {
        $wiki  = (new Wiki)->where('id', '=', $page->wiki_id)->first();
        activity()
            ->useLog('created_wiki_page')
            ->performedOn((new WikiPage))
            ->causedBy(Auth::user()->id)
            ->withProperties(['log_type' => 'created wiki page', 'wiki_id' => $wiki->id, 'wiki_name' => $wiki->name, 'page_id' => $page->id, 'page_name' => $page->name, 'user_id' => Auth::user()->id])
            ->log('<a href="/users/:properties.user_id">:causer.name</a> :properties.log_type <a href="/wikis/:properties.wiki_id/pages/:properties.page_id">:properties.page_name</a> at <a href="/wikis/:properties.wiki_id">:properties.wiki_name</a>.');
        return true;
    }
}