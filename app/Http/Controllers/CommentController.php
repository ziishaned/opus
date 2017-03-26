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
    	$this->request = $request;
        $this->comment = $comment;
        $this->page    = $page;
    }

    public function storeWikiComment(Team $team, Space $space, Wiki $wiki)
    {     
        $this->validate($this->request, Comment::COMMENT_RULES);

        preg_match_all('/(?<= |^)@[^@ ]+/', $this->request->get('comment'), $matches);
        if(count($matches) === 1 && !empty($matches[0])) {
            $this->notifyMentionedUsers($matches, $wiki);
        }

        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="$1" class="user-mention">@$1</a>', $this->request->get('comment'));

        $this->comment->storeWikiComment($wiki->id, $this->request->all());

        return redirect()->route('wikis.show', [$team->slug, $space->slug, $wiki->slug])->with([
            'alert'      => 'Comment successfully posted.',
            'alert_type' => 'success'
        ]);
    }

    public function notifyMentionedUsers($mentions, $wiki, $page = null)
    {
        foreach($mentions as $mention) {
            $mention = str_replace('@', '', $mention);

            $user = \App\Models\User::where('slug', $mention)->first();

            if(is_null($page)) {
                $url = route('wikis.show', [Auth::user()->getTeam()->slug, $wiki->space->slug, $wiki->slug]);
                \Notifynder::category('wiki.user.mentioned')
                       ->from(Auth::user()->id)
                       ->to($user->id)
                       ->url($url)
                       ->extra(['wiki_name' => $wiki->name, 'username' => Auth::user()->name])
                       ->send();
            } else {
                $url = route('pages.show', [Auth::user()->getTeam()->slug, $wiki->space->slug, $wiki->slug, $page->slug]);
                \Notifynder::category('page.user.mentioned')
                       ->from(Auth::user()->id)
                       ->to($user->id)
                       ->url($url)
                       ->extra(['wiki_name' => $wiki->name, 'username' => Auth::user()->name, 'page_name' => $page->name])
                       ->send();
            }
            
        }

        return true;
    }

    public function storePageComment(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        
        $this->validate($this->request, Comment::COMMENT_RULES);
        
        preg_match_all('/(?<= |^)@[^@ ]+/', $this->request->get('comment'), $matches);
        if(count($matches) === 1 && !empty($matches[0])) {
            $this->notifyMentionedUsers($matches, $wiki, $page);
        }   

        $this->request['comment'] = preg_replace('/(?<= |^)@([\w\d]+)/', '<a href="$1" class="user-mention">@$1</a>', $this->request->get('comment'));
        
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
