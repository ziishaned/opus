<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Integration;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    protected $request;

    protected $integration;

    public function __construct(Request $request, Integration $integration)
    {
        $this->request = $request;
        $this->integration = $integration;
    }

    public function storeSlackIntegration(Team $team)
    {
        $this->validate($this->request, Integration::INTEGRATION_RULES);

        $teamIntegration = $this->integration->storeSlackIntegration($this->request->all(), $team->id);

        foreach ($this->request->integrations as $integration) {
            DB::table('team_integration_actions')->insert([
                'integration_id' => $teamIntegration->id,
                'integration_action_id' => $integration,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('teams.integration', [$team->slug])->with([
            'alert'      => 'Integration successfully set on team.',
            'alert_type' => 'success',
        ]);
    }
}
