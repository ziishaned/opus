<?php

namespace App\Notifications\Space;

use App\Models\Space;
use App\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\SlackMessage;

class UpdateSpaceNotification extends BaseNotification
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
            ->attachment(function ($attachment) {
                $attachment
                    ->content(':floppy_disk: <' . route('users.show', [$this->space->team->slug, $this->space->user->slug,]) . '|' . $this->space->user->first_name . ' ' . $this->space->user->last_name . '> just updated a space  <' . route('categories.wikis', [$this->space->team->slug, $this->space->slug,]) . '|' . $this->space->name . '>');
            });
    }
}
