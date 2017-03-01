@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
          Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="team-info">
                <div style="width: 500px; margin: auto;">
                    <h2>Create New Group</h2>
                    <form action="" method="POST" role="form">
                        <div class="form-group with-icon">
                            <label>Group Name</label>
                            <input type="text" class="form-control input">
                            <i class="fa fa-users icon" style="line-height: 2.8;"></i>
                        </div>
                        <div class="form-group">
                            <label style="margin-top: 5px; margin-bottom: 0px;">Permissions</label>
                            <div class="permissions-input-group">
                                <div class="permissions-top">
                                    <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                        <li>Roles</li>
                                        <li>Add</li>
                                        <li>Delete</li>
                                    </ul>
                                </div>
                                <div class="permission-body">
                                    <div class="permission-group">
                                        <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                            <li>Teams</li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" value="" checked>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" value="">
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="permission-group">
                                        <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                            <li>Comments</li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" value="" checked>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" value="">
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="permission-group">
                                        <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                            <li>Pages</li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" value="" checked>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <input type="checkbox" value="">
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Select Members</label>
                            <select class="js-example-basic-multiple js-states form-control" multiple="multiple"></select>
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Create</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection