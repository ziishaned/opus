<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Team;
use App\Models\User;

/**
 * Class NotificationController
 *
 * @package App\Http\Controllers
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class NotificationController extends Controller
{
    /**
     * Mark all notifications as read.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function readAll(Team $team, User $user)
    {
        Auth::user()->readAllNotifications();

        return redirect()->back();
    }

    /**
     * Get all notifications that are not read by user.
     *
     * @return mixed
     */
    public function getNotificationsNotRead()
    {
        $query = Auth::user()->getNotificationRelation()->byRead(0)->orderBy('created_at', 'desc');

        return $query->get();
    }
}
