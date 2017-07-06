<?php

namespace App\Http\Controllers;

use Auth;
use Emoji;
use Notifynder;
use App\Models\User;
use App\Models\Team;
use App\Models\Wiki;
use App\Models\Page;
use App\Models\Space;
use App\Models\Comment;
use Illuminate\Http\Request;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class CommentController extends Controller
{
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
     * @var \App\Models\User
     */
    protected $user;

    /**
     * CommentController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Page         $page
     * @param \App\Models\Comment      $comment
     * @param \App\Models\User         $user
     */
    public function __construct(Request $request, Page $page, Comment $comment, User $user)
    {
        $this->page    = $page;
        $this->user    = $user;
        $this->request = $request;
        $this->comment = $comment;
    }

    /**
     * Create a new wiki comment.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeWikiComment(Team $team, Space $space, Wiki $wiki)
    {
        $this->validate($this->request, Comment::COMMENT_RULES);

        preg_match_all('/(?<= |^)@[^@ ]+/', $this->request->get('comment'), $matches);
        if (count($matches) === 1 && !empty($matches[0])) {
            $this->notifyMentionedUsers($matches, $wiki);
        }

        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="http://opus.dev/teams/'.$team->slug.'/users/$1" class="user-mention">@$1</a>', $this->request->get('comment'));

        $this->comment->storeComment($wiki->id, Wiki::class, $this->request->all());

        return redirect()->route('wikis.show', [$team->slug, $space->slug, $wiki->slug])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Notify all users that are mentioned in comment.
     *
     * @param      $mentions
     * @param      $wiki
     * @param null $page
     * @return bool
     */
    public function notifyMentionedUsers($mentions, $wiki, $page = null)
    {
        foreach ($mentions as $mention) {
            $mention = str_replace('@', '', $mention);

            $user = $this->user->getUser($mention);
            ;

            if (is_null($page)) {
                $url = route('wikis.show', [Auth::user()->getTeam()->slug, $wiki->space->slug, $wiki->slug]);
                Notifynder::category('wiki.user.mentioned')
                    ->from(Auth::user()->id)
                    ->to($user->id)
                    ->url($url)
                    ->extra(['wiki_name' => $wiki->name, 'username' => Auth::user()->name])
                    ->send();
            } else {
                $url = route('pages.show', [Auth::user()->getTeam()->slug, $wiki->space->slug, $wiki->slug, $page->slug]);
                Notifynder::category('page.user.mentioned')
                    ->from(Auth::user()->id)
                    ->to($user->id)
                    ->url($url)
                    ->extra(['wiki_name' => $wiki->name, 'username' => Auth::user()->name, 'page_name' => $page->name])
                    ->send();
            }
        }

        return true;
    }

    /**
     * Create a new page comment.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @param \App\Models\Page  $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePageComment(Team $team, Space $space, Wiki $wiki, Page $page)
    {

        $this->validate($this->request, Comment::COMMENT_RULES);

        preg_match_all('/(?<= |^)@[^@ ]+/', $this->request->get('comment'), $matches);
        if (count($matches) === 1 && !empty($matches[0])) {
            $this->notifyMentionedUsers($matches, $wiki, $page);
        }

        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="http://opus.dev/teams/'.$team->slug.'/users/$1" class="user-mention">@$1</a>', $this->request->get('comment'));

        $this->comment->storeComment($page->id, Page::class, $this->request->all());

        return redirect()->route('pages.show', [$team->slug, $space->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Delete comment.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $this->comment->deleteComment($this->request->get('commentId'));

        return response()->json([
            'deleted' => true,
        ], 200);
    }

    /**
     * Update comment.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->validate($this->request, Comment::COMMENT_RULES);

        $this->comment->updateComment($this->request->all());

        $encodedComment = $this->request->get('comment');

        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="http://opus.dev/teams/'.$team->slug.'/users/$1" class="user-mention">@$1</a>', $this->request->get('comment'));
        $this->request['comment'] = (new Emoji)->render($this->request->get('comment'));

        return response()->json([
            'encodedComment' => $encodedComment,
            'decodedComment' => $this->request['comment'],
        ], 200);
    }
}
