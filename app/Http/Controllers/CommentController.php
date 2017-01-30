<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Category;
use App\Models\Wiki;
use App\Models\Comment;
use App\Models\WikiPage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CommentController
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
	protected $request;

    /**
     * @var \App\Models\Comment
     */
	protected $comment;

    /**
     * @var \App\Models\WikiPage
     */
    protected $wikiPage;

    /**
     * CommentController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment      $comment
     */
    public function __construct(Request $request, WikiPage $wikiPage, Comment $comment) {
    	$this->request      =  $request;
        $this->comment      =  $comment;
        $this->wikiPage     =  $wikiPage;
    }

    /**
     * Create a new resource.
     *
     * @param string  $wikiSlug
     * @param string $pageSlug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Organization $organization, Category $category, Wiki $wiki, WikiPage $page)
    {
        $this->validate($this->request, Comment::COMMENT_RULES);
        
        $this->comment->storeComment($page->id, $this->request->all());

        return redirect()->route('pages.show', [$organization->slug, $category->slug, $wiki->slug, $page->slug])->with([
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
