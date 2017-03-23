<?php

namespace App\Http\Controllers;

use App\Models\{Team, Wiki, Space};
use Illuminate\Http\Request;

class SpaceConroller extends Controller
{
	private $request;

    private $team;

    private $space;

    public function __construct(Request $request, Team $team, Space $space)
    {
    	$this->space   =  $space;
        $this->request =  $request;
        $this->team    =  $team;
    }

    public function create(Team $team)
    {
        return view('space.create', compact('team'));
    }

    public function store(Team $team)
    {
        $this->validate($this->request, Space::SPACE_RULES);
        
        $this->space->createSpace($this->request->all(), $team->id);

        return redirect()->route('dashboard', ['team_slug' => $team->slug])->with([
            'alert' => 'Space successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function destroy(Team $team, Space $space) 
    {
        $this->space->deleteSpace($space->id);

        return redirect()->back()->with([
            'alert' => 'Space successfully deleted.',
            'alert_type' => 'success'
        ]);
    }

    public function update(Team $team, Space $space)
    {
        $this->validate($this->request, Space::SPACE_RULES);
        
        $this->space->updateSpace($this->request->all(), $space->id, $team->id);

        return redirect()->back()->with([
            'alert' => 'Space successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    public function getSpaceWikis(Team $team, Space $space)
    {
        $wikis = (new Wiki)->where('team_id', $team->id)->where('Space_id', $space->id)->latest()->paginate(30);

        $spaces = $this->space->getTeamSpaces($team->id);

        return view('space.index', compact('team', 'space', 'spaces', 'wikis'));
    }

    public function getTeamSpaces(Team $team)
    {
        return $this->space->where('team_id', $team->id)->with(['team'])->orderBy('name', 'asc')->get();
    }
}
