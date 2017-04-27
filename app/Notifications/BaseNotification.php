<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class BaseNotification extends Notification
{
    use Queueable;

    protected $from = 'opus';

    public function via($notifiable)
    {
        return ['slack'];
    }
}
