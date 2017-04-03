<?php

namespace Database\Seeds\Components\Team;

use Carbon\Carbon;
use App\Models\Invite;
use Illuminate\Database\Seeder;

/**
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class InvitesTableSeeder extends Seeder
{
	/**
     * Path to invites.json file.
     * 
     * @var string
     */
    private $invitationsFilePath = 'database/seeds/Components/Team/invitations.json';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invitations = $this->getInvitations();
        
        foreach ($invitations as $invitation) {
		    Invite::insert([
                'code'  	 => $invitation['code'],
                'email' 	 => $invitation['email'],
                'team_id' 	 => $invitation['team_id'],
                'role_id'    => $invitation['role_id'],
                'created_at' => Carbon::now(), 
			    'updated_at' => Carbon::now()
            ]); 
        }
    }

    /**
     * Get the invitations from json file. 
     * 
     * @return array $invitations
     */
    private function getInvitations()
    {
        $invitations = file_get_contents(base_path($this->invitationsFilePath));

        return json_decode($invitations, true);
    }
}
