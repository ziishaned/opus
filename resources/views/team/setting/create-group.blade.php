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
                            <h2 style="margin-bottom: 35px;">Create Group</h2>
                        </div>
                    </div>
                    <div class="">
                        <form action="{{ route('groups.post', [ $team->slug ]) }}" method="POST" role="form">
                            <div class="form-group with-icon">
                                <label for="group-name">Group Name</label> 
                                <input type="text" name="group_name" class="form-control" id="group-name" required>
                                <i class="fa fa-users icon" style="line-height: 2.8;"></i>
                            </div> 
                            <div class="form-group">
                                <label style="margin-top: 5px; margin-bottom: 0px;">Permissions</label> 
                                <div class="permissions-input-group">
                                    <div class="permissions-top">
                                        <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                                            <li>Roles</li> 
                                        </ul>
                                    </div> 
                                    <div class="permission-body">
                                        <div class="permission-group">
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                                                <li>Administrator</li>                                              
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="administrator">
                                                    </label>
                                                </li>
                                            </ul>
                                        </div> 
                                        <div class="permission-group">
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                                                <li>Viewer</li> 
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="viewer">
                                                    </label>
                                                </li>
                                            </ul>
                                        </div> 
                                        <div class="permission-group">
                                            <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                                                <li>Editor</li> 
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="editor">
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="group-member-select">Select Members</label> 
                                <select multiple="" name="group_members[]" class="form-control" id="group-member-select" required></select>
                            </div> 
                            <ul class="list-unstyled list-inline pull-right">
                                <li>
                                    <a href="groups.html" class="btn btn-default pull-right">Close</a> 
                                </li>
                                <li>
                                    <button type="submit" class="btn btn-success pull-right">Create</button> 
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection