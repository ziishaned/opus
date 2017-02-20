@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
          Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="tab-content">
                <div class="team-info">
                    <h2>Invite New User</h2>
                    <form action="" method="POST" class="form-inline" role="form">
                        <div class="form-group with-icon">
                            <input type="text" class="form-control input" placeholder="example@example.com" style="width: 255px;">
                            <i class="fa fa-user-o icon"></i>
                        </div>
                        <select name="" id="input" class="form-control" required="required">
                            <option value="viewer">Viewer</option>
                            <option value="editor">Editor</option>
                        </select>
                        <button type="submit" class="btn btn-success pull-right">Invite</button>
                    </form>
                </div>
                <div class="team-members">
                    <h2>Current Members</h2>
                    <div class="member-list">
                        <div class="media member-list-item">
                            <a class="pull-left" href="#">
                                <img src="/img/elliot.jpg" class="media-object img-circle" alt="">
                            </a>
                            <div class="media-body">
                                <div class="pull-left user-info-con">
                                    <h4 class="media-heading member-name">
                                        <a href="#">Elliot</a> <span class="member-role label label-success" style="margin-left: 10px;"><i>Owner</i></span>
                                    </h4>
                                    <div class="text-muted" style="font-family: lato; font-size: 13px;"><i class="fa fa-envelope-o fa-fw"></i> elliot@hotmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="media member-list-item">
                            <a class="pull-left" href="#">
                                <img src="/img/helen.jpg" class="media-object img-circle" alt="">
                            </a>
                            <div class="media-body">
                                <div class="pull-left user-info-con">
                                    <h4 class="media-heading member-name">
                                        <a href="#">Helen</a> <span class="member-role label label-primary" style="margin-left: 10px;"><i>Editor</i></span>
                                    </h4>
                                    <div class="text-muted" style="font-family: lato; font-size: 13px;"><i class="fa fa-envelope-o fa-fw"></i> helen@gmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="media member-list-item">
                            <a class="pull-left" href="#">
                                <img src="/img/jenny.jpg" class="media-object img-circle" alt="">
                            </a>
                            <div class="media-body">
                                <div class="pull-left user-info-con">
                                    <h4 class="media-heading member-name">
                                        <a href="#">Jenny</a> <span class="member-role label label-info" style="margin-left: 10px;"><i>Viewer</i></span>
                                    </h4>
                                    <div class="text-muted" style="font-family: lato; font-size: 13px;"><i class="fa fa-envelope-o fa-fw"></i> jenny@hotmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="media member-list-item">
                            <a class="pull-left" href="#">
                                <img src="/img/joe.jpg" class="media-object img-circle" alt="">
                            </a>
                            <div class="media-body">
                                <div class="pull-left user-info-con">
                                    <h4 class="media-heading member-name">
                                        <a href="#">Joe</a> <span class="member-role label label-info" style="margin-left: 10px;"><i>Viewer</i></span>
                                    </h4>
                                    <div class="text-muted" style="font-family: lato; font-size: 13px;"><i class="fa fa-envelope-o fa-fw"></i> joe@gmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="media member-list-item">
                            <a class="pull-left" href="#">
                                <img src="/img/justen.jpg" class="media-object img-circle" alt="">
                            </a>
                            <div class="media-body">
                                <div class="pull-left user-info-con">
                                    <h4 class="media-heading member-name">
                                        <a href="#">Justen</a> <span class="member-role label label-info" style="margin-left: 10px;"><i>Viewer</i></span>
                                    </h4>
                                    <div class="text-muted" style="font-family: lato; font-size: 13px;"><i class="fa fa-envelope-o fa-fw"></i> justen@gmail.com</div>
                                </div>
                            </div>
                        </div>
                        <div class="media member-list-item">
                            <a class="pull-left" href="#">
                                <img src="/img/laura.jpg" class="media-object img-circle" alt="">
                            </a>
                            <div class="media-body">
                                <div class="pull-left user-info-con">
                                    <h4 class="media-heading member-name">
                                        <a href="#">Laura</a> <span class="member-role label label-info" style="margin-left: 10px;"><i>Viewer</i></span>
                                    </h4>
                                    <div class="text-muted" style="font-family: lato; font-size: 13px;"><i class="fa fa-envelope-o fa-fw"></i> laura@hotmail.com</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection