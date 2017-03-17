<?php

namespace App\Http\Controllers;

use Auth;
use Emoji;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\{Team, Space, Wiki, Comment, Page};

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

    public function storeWikiComment(Team $team, Space $space, Wiki $wiki)
    {
        $this->validate($this->request, Comment::COMMENT_RULES);

        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="$1" class="user-mention">@$1</a>', $this->request->get('comment'));

        $this->comment->storeWikiComment($wiki->id, $this->request->all());

        return redirect()->route('wikis.show', [$team->slug, $space->slug, $wiki->slug])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success'
        ]);
    }

    public function storePageComment(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="$1" class="user-mention">@$1</a>', $this->request->get('comment'));
        
        $this->validate($this->request, Comment::COMMENT_RULES);
        
        $this->comment->storePageComment($page->id, $this->request->all());

        return redirect()->route('pages.show', [$team->slug, $space->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success'
        ]);
    }

    public function destroy() 
    {
        $this->comment->where('id', $this->request->get('commentId'))->where('user_id', Auth::user()->id)->delete();
        
        return response()->json([
            'deleted' => true,
        ], 200);
    }

    public function update() {
        $this->validate($this->request, Comment::COMMENT_RULES);

        $this->comment->updateComment($this->request->all());

        $encodedComment = $this->request->get('comment');

        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="$1" class="user-mention">@$1</a>', $this->request->get('comment'));
        $this->request['comment'] = (new Emoji)->render($this->request->get('comment'));

        return response()->json([
            'encodedComment' => $encodedComment,
            'decodedComment' => $this->request['comment'],
        ], 200);
    }
}
