<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readAll(Team $team, User $user)
    {
        Auth::user()->readAllNotifications();

        return redirect()->back();
    }

    public function getNotificationsNotRead()
    {
        $query = Auth::user()->getNotificationRelation()->byRead(0)->orderBy('created_at', 'desc');
        
        return $query->get();
    }
}
