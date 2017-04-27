<?php

namespace App\Notifications\Space;

use App\Models\Space;
use App\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\SlackMessage;

class CreateSpaceNotification extends BaseNotification
{
    protected $space;

    public function __construct(Space $space)
    {
        $this->space = $space;
    }

    public function toSlack()
    {
        return (new SlackMessage)
            ->from($this->from)
            ->content(':file_cabinet: <' . route('users.show', [$this->space->team->slug, $this->space->user->slug,]) . '|' . $this->space->user->first_name . ' ' . $this->space->user->last_name . '> created a new space.')
            ->attachment(function ($attachment) {
                $attachment
                    ->title($this->space->name, route('categories.wikis', [$this->space->team->slug, $this->space->slug,]))
                    ->content('*Description:* ' . $this->space->outline)
                    ->markdown(['title', 'text']);
            });
    }
}
