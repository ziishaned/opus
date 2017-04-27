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
    public function store(Team $team)
    {
        $this->validate($this->request, Integration::INTEGRATION_RULES);

        $teamIntegration = $this->integration->storeIntegration($this->request->all(), $team->id);

        $this->createIntegrationActions($this->request->integrations, $teamIntegration);

        return redirect()->route('integrations.index', [$team->slug])->with([
            'alert'      => 'Integration successfully set on team.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Create integration actions against an integration.
     *
     * @param $integrationActions
     * @param $integration
     * @return bool
     */
    public function createIntegrationActions($integrationActions, $integration)
    {
        foreach ($integrationActions as $action) {
            DB::table('team_integration_actions')->insert([
                'integration_id'        => $integration->id,
                'integration_action_id' => $action,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]);
        }

        return true;
    }


    /**
     * Create a new slack integration view.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Team $team)
    {
        return view('integration.create', compact('team'));
    }


    /**
     * Get all the integrations of a team.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Team $team)
    {
        $integrations = (new Integration)->getTeamIntegration($team->id);

        return view('integration.index', compact('team', 'integrations'));
    }

    /**
     * Edit an integration.
     *
     * @param \App\Models\Team        $team
     * @param \App\Models\Integration $integration
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Team $team, Integration $integration)
    {
        $integrationActions = $this->getIntegrationActions($integration->integrationActions);

        return view('integration.edit', compact('team', 'integration', 'integrationActions'));
    }

    /**
     * Get the actions of an integration.
     *
     * @param $actions
     * @return array
     */
    public function getIntegrationActions($actions)
    {
        $integrationActions = [];

        foreach ($actions as $action) {
            $integrationActions[] = $action->name;
        }

        return $integrationActions;
    }

    public function update(Team $team, Integration $integration)
    {
        $this->integration->updateIntegration($integration->id, $this->request->all());

        $this->updateIntegrations($integration, $this->request->integrations);

        return redirect()->route('integrations.index', [$team->slug])->with([
            'alert'      => 'Integration successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Update actions of an integration.
     *
     * @param $integration
     * @param $integrationActions
     * @return bool
     */
    public function updateIntegrations($integration, $integrationActions)
    {
        DB::table('team_integration_actions')->where('integration_id', $integration->id)->delete();

        foreach ($integrationActions as $action) {
            DB::table('team_integration_actions')->insert([
                'integration_id'        => $integration->id,
                'integration_action_id' => $action,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]);
        }

        return true;
    }

    /**
     * Delete an integration.
     *
     * @param \App\Models\Team        $team
     * @param \App\Models\Integration $integration
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Team $team, Integration $integration)
    {
        $this->integration->deleteIntegration($integration->id);

        return redirect()->route('integrations.index', [$team->slug])->with([
            'alert'      => 'Integration successfully deleted.',
            'alert_type' => 'success',
        ]);
    }
}
