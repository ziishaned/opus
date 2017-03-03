@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
          Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="tab-content">
                <div class="s-groups-con">
                    <div class="s-group-header">
                        <div class="header">
                            <h2 style="margin-bottom: 10px;">Groups</h2>
                            <p class="text-muted">Grant permissions for this space to all the members of a group.</p>
                        </div>
                    </div>
                    <div class="s-groups-body">
                        <div class="table-responsive" style="margin-top: 30px;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th> 
                                        <th colspan="2" width="18%" class="text-center" style="font-family: lato;">Teams</th> 
                                        <th colspan="2" width="18%" class="text-center" style="font-family: lato;">Comments</th> 
                                        <th colspan="2" width="18%" class="text-center" style="font-family: lato;">Pages</th>
                                    </tr> 
                                    <tr>
                                        <th class="text-center" style="font-family: lato;">Group</th> 
                                        <th class="text-center" style="font-family: lato;">Add</th> 
                                        <th class="text-center" style="font-family: lato;">Delete</th> 
                                        <th class="text-center" style="font-family: lato;">Add</th> 
                                        <th class="text-center" style="font-family: lato;">Delete</th> 
                                        <th class="text-center" style="font-family: lato;">Add</th> 
                                        <th class="text-center" style="font-family: lato;">Delete</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <tr>
                                        <td>Developers</td> 
                                        <td class="text-center">
                                            <label>
                                                <input type="checkbox" value="" checked="checked">
                                            </label>
                                        </td> 
                                        <td class="text-center">
                                            <label>
                                                <input type="checkbox" value="">
                                            </label>
                                        </td> 
                                        <td class="text-center">
                                            <label>
                                                <input type="checkbox" value="" checked="checked">
                                            </label>
                                        </td> 
                                        <td class="text-center">
                                            <label>
                                                <input type="checkbox" value="">
                                            </label>
                                        </td> 
                                        <td class="text-center">
                                            <label>
                                                <input type="checkbox" value="" checked="checked">
                                            </label>
                                        </td> 
                                        <td class="text-center">
                                            <label>
                                                <input type="checkbox" value="">
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection