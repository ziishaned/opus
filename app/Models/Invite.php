<?php

namespace App\Models;

use Request;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invites';

    protected $fillable = [
    	'code',
    	'email',
        'team_id',
    	'group_id',
        'claimed_at',
        'created_at',
    	'updated_at',
    ];

    const INVITERULES = [
        'email' => 'required|is_already_invited|is_already_member'
    ];

    public function team()
    {
    	return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function inviteUser($data)
    {
        $team = Team::where('slug', Request::get('team_slug'))->first();

        $group = Group::where('team_id', $team->id)->where('slug', Request::get('group'))->first();

        $invitation = $this->create([
            'code' => str_rot13(base64_encode(str_rot13($data['team_slug'].$data['email']))),
            'email' => $data['email'],
            'team_id' => $team->id,
            'group_id' => $group->id,
        ]);

        return $invitation;
    }

    public function getTeamPendingInvitations($teamId)
    {
        $invitations = $this->where('team_id', $teamId)->whereNull('claimed_at')->latest()->get();

        return $invitations;
    }
}
