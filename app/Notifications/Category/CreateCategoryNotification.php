<?php

namespace App\Notifications\Category;

use App\Models\Category;
use App\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\SlackMessage;

class CreateCategoryNotification extends BaseNotification
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function toSlack()
    {
        return (new SlackMessage)
            ->to($this->channel)
            ->from($this->from)
            ->content(':file_cabinet: <' . route('users.show', [$this->category->team->slug, $this->category->user->slug,]) . '|' . $this->category->user->first_name . ' ' . $this->category->user->last_name . '> created a new category.')
            ->attachment(function ($attachment) {
                $attachment
                    ->title($this->category->name, route('categories.wikis', [$this->category->team->slug, $this->category->slug,]))
                    ->content('*Description:* ' . $this->category->outline)
                    ->markdown(['title', 'text']);
            });
    }
}