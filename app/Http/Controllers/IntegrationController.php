<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Integration;
use Illuminate\Http\Request;

/**
 * Class IntegrationController
 *
 * @package App\Http\Controllers
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class IntegrationController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \App\Models\Integration
     */
    protected $integration;

    /**
     * IntegrationController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Integration  $integration
     */
    public function __construct(Request $request, Integration $integration)
    {
        $this->request     = $request;
        $this->integration = $integration;
    }

    /**
     * Store a new slack integration.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function storeSlackIntegration(Team $team)
    {
        $this->validate($this->request, Integration::INTEGRATION_RULES);

        $teamIntegration = $this->integration->storeSlackIntegration($this->request->all(), $team->id);

        // Update all the integration actions on which user want to be notified on slack.
        foreach ($this->request->integrations as $integration) {
            DB::table('team_integration_actions')->insert([
                'integration_id'        => $teamIntegration->id,
                'integration_action_id' => $integration,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]);
        }

        return redirect()->route('teams.integration', [$team->slug])->with([
            'alert'      => 'Integration successfully set on team.',
            'alert_type' => 'success',
        ]);
    }
}
