<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class SlackNotification extends Notification
{
    use Queueable;

    protected $data;

    protected $channel = '#opus-notifications';

    protected $from = 'opus';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $category = $this->data;

        return (new SlackMessage)
            ->success()
            ->to($this->channel)
            ->from($this->from)
            ->success()
            ->content('A new category was just created by <'.route('users.show', [$category->team->slug, $category->user->slug, ]).'|'.$category->user->first_name . ' ' . $category->user->last_name.'>')
            ->attachment(function ($attachment) use ($category) {
                $attachment->title($category->name, route('categories.wikis', [$category->team->slug, $category->slug, ]))
                           ->content($category->outline);
            });
    }

} 
