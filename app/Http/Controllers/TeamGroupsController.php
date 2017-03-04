<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\TeamGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamGroupsController extends Controller
{
    protected $request;
    
    protected $group;

    public function __construct(Request $request, TeamGroups $group)
    {
        $this->request  = $request;
        $this->group    = $group;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Team $team)
    {
        $this->validate($this->request, TeamGroups::GROUP_RULES);

        $group = $this->group->createGroup($this->request->all());

        foreach ($this->request->get('group_members') as $member) {
            DB::table('users_groups')->insert([
                'group_id' => $group->id,
                'user_id' => $member,
                'team_id' => $team->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('teams.settings.groups', [$team->slug])->with([
            'alert'      => 'Group successfully created.',
            'alert_type' => 'success',
        ]);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
