<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
     * CommentController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment      $comment
     */
    public function __construct(Request $request, Comment $comment) {
    	$this->request = $request;
    	$this->comment = $comment;
    }

    /**
     * Like Comment.
     *
     * @param  integer $id
     * @return mixed
     */
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

    /**
     * Create a new resource.
     *
     * @param string  $wikiSlug
     * @param string $pageSlug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($wikiSlug, $pageSlug)
    {
        $this->validate($this->request, Comment::COMMENT_RULES);
        $this->comment->storeComment($pageSlug, $this->request->all());
        return redirect()->route('wikis.pages.show', [$wikiSlug, $pageSlug])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success'
        ]);
    }

    public function destroy($id) {
        $pageDeleted = $this->comment->deleteComment($id);
        if($pageDeleted) {
            return redirect()->back()->with([
                'alert' => 'Comment successfully deleted.',
                'alert_type' => 'success'
            ]);
        }
        return response()->json([
            'message' => 'We are having some issues.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function update($id) {
        $this->validate($this->request, Comment::COMMENT_RULES);
        $this->comment->updateComment($id, $this->request->all());
        return redirect()->back()->with([
            'alert'       => 'Comment successfully updated.',
            'alert_type'  => 'success'
        ]);
    }
}
