<?php

namespace App\Notifications\Wiki;

use App\Models\Wiki;
use App\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\SlackMessage;

class CreateWikiNotification extends BaseNotification
{

    protected $wiki;

    public function __construct(Wiki $wiki)
    {
        $this->wiki = $wiki;
    }

    public function toSlack()
    {
        return (new SlackMessage)
            ->success()
            ->from($this->from)
            ->success()
            ->content(':book: <' . route('users.show', [$this->wiki->team->slug, $this->wiki->user->slug,]) . '|' . $this->wiki->user->first_name . ' ' . $this->wiki->user->last_name . '> created a new wiki.')
            ->attachment(function ($attachment) {
                $attachment
                    ->title($this->wiki->space->name . '/' . $this->wiki->name, route('wikis.show', [$this->wiki->team->slug, $this->wiki->space->slug, $this->wiki->slug,]))
                    ->content('*Description:* ' . $this->wiki->outline)
                    ->markdown(['title', 'text']);
            });
    }
}
