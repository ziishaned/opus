<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Category;
use App\Models\Wiki;
use App\Models\Comment;
use App\Models\Page;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
	protected $request;

	protected $comment;

    protected $page;

    public function __construct(Request $request, Page $page, Comment $comment) {
    	$this->request      =  $request;
        $this->comment      =  $comment;
        $this->page     =  $page;
    }

    public function storeWikiComment(Team $team, Category $category, Wiki $wiki)
    {
        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="$1" class="user-mention">@$1</a>', $this->request->get('comment'));
        
        $this->validate($this->request, Comment::COMMENT_RULES);
        
        $this->comment->storeWikiComment($wiki->id, $this->request->all());

        return redirect()->route('wikis.show', [$team->slug, $category->slug, $wiki->slug])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success'
        ]);
    }

    public function storePageComment(Team $team, Category $category, Wiki $wiki, Page $page)
    {
        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="$1" class="user-mention">@$1</a>', $this->request->get('comment'));
        
        $this->validate($this->request, Comment::COMMENT_RULES);
        
        $this->comment->storePageComment($page->id, $this->request->all());

        return redirect()->route('pages.show', [$team->slug, $category->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success'
        ]);
    }

    public function destroy($organizationSlug, $wikiSlug, $pageSlug, $id) 
    {
        $page = $this->wikiPage->getPage($pageSlug);
        $organization = (new \App\Models\Organization)->getOrganization($organizationSlug);

        $this->comment->deleteComment($id);

        return redirect()->back()->with([
            'alert' => 'Comment successfully deleted.',
            'alert_type' => 'success'
        ]);
    }

    public function update($organizationId, $wikiId, $pageId, $commentId) {
        $page = $this->wikiPage->find($pageId);

        $this->validate($this->request, Comment::COMMENT_RULES);
        
        $this->comment->updateComment($commentId, $this->request->all());

        return redirect()->back()->with([
            'alert'       => 'Comment successfully updated.',
            'alert_type'  => 'success'
        ]);
    }
}
