<?php 

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;

class NotificationComposer
{
    protected $notifications;

    public function __construct()
    {
    	if(Auth::user()) {
	    	$this->notifications = Auth::user()->getNotifications();
    	}
    }

    public function compose(View $view)
    {
        $view->with('notifications', $this->notifications);
    }
}