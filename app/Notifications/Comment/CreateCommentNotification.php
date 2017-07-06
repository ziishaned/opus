<?php

namespace App\Notifications\Comment;

use Auth;
use App\Models\Comment;
use App\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\SlackMessage;

class CreateCommentNotification extends BaseNotification
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function toSlack()
    {
        $this->comment->content = preg_replace('/<a href="(.*?)" .*?>(.*?)<\/a>/', '<'. url('http://opus.dev/teams/'.Auth::user()->team->first()->slug.'/users/$1') .'|$2>', $this->comment->content);

        if (preg_match('/Wiki/', $this->comment->subject_type)) {
            return (new SlackMessage)
                ->from($this->from)
                ->content(':speech_balloon: <' . route('users.show', [$this->comment->user->team->first()->slug, $this->comment->user->slug,]) . '|' . $this->comment->user->first_name . ' ' . $this->comment->user->last_name . '> commented on wiki <' . route('wikis.show', [$this->comment->user->team->first()->slug, $this->comment->subject->space->slug, $this->comment->subject->slug,]) . '|' . $this->comment->subject->space->slug . '/' . $this->comment->subject->slug . '>')
                ->attachment(function ($attachment) {
                    $attachment
                        ->content($this->comment->content);
                });
        };

        return (new SlackMessage)
                ->from($this->from)
                ->content(':speech_balloon: <' . route('users.show', [$this->comment->user->team->first()->slug, $this->comment->user->slug,]) . '|' . $this->comment->user->first_name . ' ' . $this->comment->user->last_name . '> commented on page <' . route('pages.show', [$this->comment->user->team->first()->slug, $this->comment->subject->wiki->space->slug, $this->comment->subject->wiki->slug, $this->comment->subject->slug]) . '|' . $this->comment->subject->wiki->slug . '/' . $this->comment->subject->slug . '>')
                ->attachment(function ($attachment) {
                    $attachment
                        ->content($this->comment->content);
                });
    }
}
