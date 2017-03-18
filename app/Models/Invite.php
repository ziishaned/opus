<?php

namespace App\Models;

use Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invites';

    protected $fillable = [
    	'code',
    	'email',
        'team_id',
    	'role_id',
        'claimed_at',
        'created_at',
    	'updated_at',
    ];

    const INVITE_RULES = [
        'email' => 'required|is_already_invited|is_already_member'
    ];

    public function team()
    {
    	return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function inviteUser($data)
    {
        $team = Team::where('slug', Request::get('team_slug'))->first();

        $role = Role::where('team_id', $team->id)->where('slug', Request::get('role'))->first();

        $invitation = $this->create([
            'code' => str_rot13(base64_encode(str_rot13($data['team_slug'].$data['email']))),
            'email' => $data['email'],
            'team_id' => $team->id,
            'role_id' => $role->id,
        ]);

        return $invitation;
    }

    public function getInvitation($teamId, $hash)
    {
        $invitation = $this->where('team_id', $teamId)->where('code', $hash)->first();

        return $invitation;
    }

    public function getTeamPendingInvitations($teamId)
    {
        $invitations = $this->where('team_id', $teamId)->whereNull('claimed_at')->latest()->get();

        return $invitations;
    }

    public function claimAccount($teamId, $hash)
    {
        $this->where('team_id', $teamId)->where('code', $hash)->update([
            'claimed_at' => Carbon::now(),
        ]);

        return true;
    }
}
