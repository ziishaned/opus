<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Wiki;
use App\Models\Space;
use Illuminate\Http\Request;

/**
 * Class SpaceController
 *
 * @package App\Http\Controllers
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class SpaceController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * @var \App\Models\Team
     */
    private $team;

    /**
     * @var \App\Models\Space
     */
    private $space;

    /**
     * @var \App\Models\Wiki
     */
    private $wiki;

    /**
     * SpaceController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team         $team
     * @param \App\Models\Space        $space
     * @param \App\Models\Wiki         $wiki
     */
    public function __construct(Request $request, Team $team, Space $space, Wiki $wiki)
    {
        $this->team    = $team;
        $this->wiki    = $wiki;
        $this->space   = $space;
        $this->request = $request;
    }

    /**
     * Show a view to create a new space.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function create(Team $team)
    {
        return view('space.create', compact('team'));
    }

    /**
     * Create a new space.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Team $team)
    {
        $this->validate($this->request, Space::SPACE_RULES);

        $this->space->createSpace($this->request->all(), $team->id);

        return redirect()->route('dashboard', ['team_slug' => $team->slug])->with([
            'alert'      => 'Space successfully created.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Delete a space.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Team $team, Space $space)
    {
        $this->space->deleteSpace($space->id);

        return redirect()->back()->with([
            'alert'      => 'Space successfully deleted.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Update a space.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Team $team, Space $space)
    {
        $this->validate($this->request, Space::SPACE_RULES);

        $this->space->updateSpace($this->request->all(), $space->id, $team->id);

        return redirect()->back()->with([
            'alert'      => 'Space successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Get all wikis of a space.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSpaceWikis(Team $team, Space $space)
    {
        $wikis = $this->wiki->getSpaceWikis($space->id, $team->id);

        $spaces = $this->space->getTeamSpaces($team->id);

        return view('space.index', compact('team', 'space', 'spaces', 'wikis'));
    }

    /**
     * Get all the spaces of a team.
     *
     * @param \App\Models\Team $team
     * @return mixed
     */
    public function getTeamSpaces(Team $team)
    {
        return $this->space->getTeamSpaces($team->id);
    }
}
