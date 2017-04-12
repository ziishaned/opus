<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Page;
use App\Models\Wiki;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;

/**
 * Class LikeController
 *
 * @package App\Http\Controllers
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class LikeController extends Controller
{
    /**
     * @var \App\Models\Like
     */
    protected $like;

    /**
     * @var \App\Models\Wiki
     */
    protected $wiki;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \App\Models\Page
     */
    protected $page;

    /**
     * @var \App\Models\Comment
     */
    protected $comment;

    /**
     * LikeController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Like         $like
     * @param \App\Models\Wiki         $wiki
     * @param \App\Models\Page         $page
     * @param \App\Models\Comment      $comment
     */
    public function __construct(Request $request, Like $like, Wiki $wiki, Page $page, Comment $comment)
    {
        $this->request = $request;
        $this->like    = $like;
        $this->wiki    = $wiki;
        $this->page    = $page;
        $this->comment = $comment;
    }

    /**
     * Check type of subject(Comment, Wiki, Page) that is liked and then store the like if the subject
     * is un-liked then remove the like.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLike()
    {
        if ($this->request->get('subjectType') === 'wiki') {
            $wiki = $this->wiki->getWiki($this->request->get('subject'));

            $like = $this->handleLike(Wiki::class, $wiki->id);

            if ($like) {
                return response()->json([
                    'like' => true,
                ], 200);
            }

            return response()->json([
                'like' => false,
            ], 200);
        }

        if ($this->request->get('subjectType') === 'page') {
            $page = $this->page->getPage($this->request->get('subject'));

            $like = $this->handleLike(Page::class, $page->id);

            if ($like) {
                return response()->json([
                    'like' => true,
                ], 200);
            }

            return response()->json([
                'like' => false,
            ], 200);
        }

        if ($this->request->get('subjectType') === 'comment') {
            $comment = $this->comment->find($this->request->get('subject'));

            $like = $this->handleLike(Comment::class, $comment->id);

            if ($like) {
                return response()->json([
                    'like' => true,
                ], 200);
            }

            return response()->json([
                'like' => false,
            ], 200);
        }

        abort(404);
    }

    /**
     * Create new like or if like already exists then restore it.
     *
     * @param $subject
     * @param $subjectId
     * @return bool
     */
    public function handleLike($subject, $subjectId)
    {
        $existing_like = $this
            ->like
            ->withTrashed()
            ->where('subject_id', $subjectId)
            ->where('subject_type', $subject)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (is_null($existing_like)) {
            Like::create([
                'subject_id'   => $subjectId,
                'subject_type' => $subject,
                'user_id'      => Auth::user()->id,
            ]);

            return true;
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();

                return false;
            } else {
                $existing_like->restore();

                return true;
            }
        }
    }
}
