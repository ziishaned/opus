<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Http\Controllers\NotificationController;
use Illuminate\View\View;

class NotificationComposer
{
    protected $notifications;

    public function __construct()
    {
        if (Auth::user()) {
            $this->notifications = (new NotificationController())->getNotificationsNotRead();
        }
    }

    public function compose(View $view)
    {
        $view->with('notifications', $this->notifications);
    }
}
