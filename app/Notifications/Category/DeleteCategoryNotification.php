<?php

namespace App\Notifications\Category;

use App\Models\Category;
use App\Notifications\BaseNotification;
use Illuminate\Notifications\Messages\SlackMessage;

class DeleteCategoryNotification extends BaseNotification
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
            ->attachment(function ($attachment) {
                $attachment
                    ->content(':wastebasket: <' . route('users.show', [$this->category->team->slug, $this->category->user->slug,]) . '|' . $this->category->user->first_name . ' ' . $this->category->user->last_name . '> just deleted a category  <' . route('categories.wikis', [$this->category->team->slug, $this->category->slug,]) . '|' . $this->category->name . '>');
            });
    }
}