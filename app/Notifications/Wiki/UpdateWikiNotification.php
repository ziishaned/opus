<?php

namespace App\Notifications\Wiki;

use App\Models\Wiki;
use App\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\SlackMessage;

class UpdateWikiNotification extends BaseNotification
{
    protected $wiki;

    public function __construct(Wiki $wiki)
    {
        $this->wiki = $wiki;
    }

    public function toSlack()
    {
        return (new SlackMessage)
            ->from($this->from)
            ->attachment(function ($attachment) {
                $attachment
                    ->content(':floppy_disk: <' . route('users.show', [$this->wiki->team->slug, $this->wiki->user->slug,]) . '|' . $this->wiki->user->first_name . ' ' . $this->wiki->user->last_name . '> updated a wiki <' . route('wikis.show', [$this->wiki->team->slug, $this->wiki->space->slug, $this->wiki->slug,]) . '|' . $this->wiki->space->name . '/' . $this->wiki->name . '>');
            });
    }
}
