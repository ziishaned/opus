<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
	protected $request;

	protected $comment;

    public function __construct(Request $request, Comment $comment) {
    	$this->request = $request;
    	$this->comment = $comment;
    }

    public function starComment($id)
    {
        $star = $this->comment->starComment($id);
        if($star) {
            return response()->json([
                'star' => true
            ], Response::HTTP_CREATED);          
        }
        return response()->json([
            'unstar' => true
        ], Response::HTTP_ACCEPTED);
    }

    public function store($wikiId, $pageId)
    {
        $this->validate($this->request, Comment::COMMENT_RULES);
        $this->comment->storeComment($pageId, $this->request->all());
        return redirect()->route('wikis.pages.show', [$wikiId, $pageId])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success'
        ]);
    }
}
