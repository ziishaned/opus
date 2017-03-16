<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Team;
use App\Models\Invite;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    protected $request;

    protected $invite;

    public function __construct(Request $request, Invite $invite)
    {
        $this->request = $request;
        $this->invite  = $invite;
    }

    public function index()
    {
        
    }

    public function create()
    {
        
    }

    public function store(Team $team)
    {
        $this->validate($this->request, Invite::INVITERULES, [
            'is_already_invited' => 'A user with this email already invited.',
            'is_already_member'  => 'A user with this email already exists.'
        ]);

        $invitation = $this->invite->inviteUser($this->request->all());

        $this->sendInvitationEmail($invitation, $team);
    
        return redirect()->back()->with([
            'alert'      => 'Invitation is successfully sent to user.',
            'alert_type' => 'success',
        ]);        
    }

    public function sendInvitationEmail($invitation, $team)
    {
        Mail::send('mails.invitation', ['invitation' => $invitation, 'team' => $team], function ($message) use ($invitation, $team) {
            $message->from('opus@info.com', 'Opus');
            $message->subject('Invitation request from ' . $team->name . '.');
            $message->to($invitation->email);
        });

        return true;
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy(Team $team, $invitationCode)
    {
        $this->invite->where('code', $invitationCode)->where('team_id', $team->id)->delete();
    
        return redirect()->back()->with([
            'alert'      => 'Invitation successfully removed.',
            'alert_type' => 'success',
        ]);
    }
}
