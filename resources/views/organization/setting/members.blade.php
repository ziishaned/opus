@extends('layouts.app')

@section('content')
    <div class="team-general-setting">
        <div class="heading text-center">
            <h1>Team Settings</h1>
        </div>
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation">
                    <a href="{{ route('organizations.settings.general', [$organization->slug]) }}">General</a>
                </li>
                <li role="presentation" class="active">
                    <a href="{{ route('organizations.settings.members', [$organization->slug]) }}"">Members</a>
                </li>
                <li role="presentation">
                    <a href="">Subscription</a>
                </li>
            </ul>
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
                        <button type="submit" class="save-team-info pull-right">Invite</button>
                    </form>
                </div>
                <div class="team-members">
                    <h2>Current Members</h2>
                    <div class="member-list">
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img src="{!! new Avatar('Zeeshan Ahmed', 'square', 44) !!}" class="media-object img-circle" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading member-name">Zeeshan Ahmed</h4>
                                <p class="text-muted member-role"><i>Owner</i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
