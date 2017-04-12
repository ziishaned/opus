<?php

namespace App\Models;

use Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invite
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Invite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'email', 'team_id', 'role_id', 'claimed_at', 'created_at', 'updated_at',
    ];

    const INVITE_RULES = [
        'email' => 'required|is_already_invited|is_already_member',
    ];

    /**
     * Get the user that are invited by a team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * Invite a user to a team
     *
     * @param $data array
     * @return static
     */
    public function inviteUser($data)
    {
        $team = Team::where('slug', Request::get('team_slug'))->first();

        $role = Role::where('team_id', $team->id)->where('slug', Request::get('role'))->first();

        return $this->create([
            'code'    => str_rot13(base64_encode(str_rot13($data['team_slug'] . $data['email']))),
            'email'   => $data['email'],
            'team_id' => $team->id,
            'role_id' => $role->id,
        ]);
    }

    /**
     * Get all the invitation of a team.
     *
     * @param $teamId integer
     * @param $hash
     * @return mixed
     */
    public function getInvitation($teamId, $hash)
    {
        return $this->where('team_id', $teamId)->where('code', $hash)->first();
    }

    /**
     * Get all the pending invitations of a team.
     *
     * @param $teamId integer
     * @return mixed
     */
    public function getTeamPendingInvitations($teamId)
    {
        return $this->where('team_id', $teamId)->whereNull('claimed_at')->latest()->get();
    }

    /**
     * When a user joins a team claim his invitation.
     *
     * @param $teamId integer
     * @param $hash
     * @return mixed
     */
    public function claimAccount($teamId, $hash)
    {
        return $this->where('team_id', $teamId)->where('code', $hash)->update([
            'claimed_at' => Carbon::now(),
        ]);
    }

    /**
     * Delete pending invitation.
     *
     * @param $invitationCode
     * @param $teamId
     * @return mixed
     */
    public function deleteInvitation($invitationCode, $teamId)
    {
        return $this->where('code', $invitationCode)->where('team_id', $teamId)->delete();
    }
}
