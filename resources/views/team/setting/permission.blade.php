@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
          Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="tab-content">
                <div style="margin-top: 40px;">
                    <h3>Groups</h3>
                    <p class="text-muted">Grant permissions for this space to all the members of a group.</p>
                    <div class="table-responsive" style="margin-top: 30px;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="2" class="text-center" width="18%" style="font-family: lato;">Teams</th>
                                    <th colspan="2" class="text-center" width="18%" style="font-family: lato;">Comments</th>
                                    <th colspan="2" class="text-center" width="18%" style="font-family: lato;">Pages</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><b style="font-family: lato;">Group</b></td>
                                    <td class="text-center" style="font-family: lato;"><b>Add</b></td>
                                    <td class="text-center" style="font-family: lato;"><b>Delete</b></td>
                                    <td class="text-center" style="font-family: lato;"><b>Add</b></td>
                                    <td class="text-center" style="font-family: lato;"><b>Delete</b></td>
                                    <td class="text-center" style="font-family: lato;"><b>Add</b></td>
                                    <td class="text-center" style="font-family: lato;"><b>Delete</b></td>
                                </tr>
                                <tr>    
                                    <td>Developers</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" >
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" >
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" >
                                        </label>
                                    </td>
                                </tr>
                                <tr>    
                                    <td>IT</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                </tr>
                                <tr>    
                                    <td>IT Project Managers</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                </tr>
                                <tr>    
                                    <td>Product Mob App</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                </tr>
                                <tr>    
                                    <td>QA</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                </tr>
                                <tr>    
                                    <td>QA Management Team</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                </tr>
                                <tr>    
                                    <td>Yopeso</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                </tr>
                                <tr>    
                                    <td>administrators</td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label>
                                            <input type="checkbox" value="" checked>
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
@endsection