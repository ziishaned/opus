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
                    <h2>Invite user</h2>
                    <form action="{{ route('invites.create', [$team->slug]) }}" method="POST" class="form-inline" role="form">
                        <input type="text" name="team_slug" class="hidden" value="{{ $team->slug }}">
                        <div class="form-group with-icon {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="text" name="email" class="form-control" placeholder="example@example.com" style="width: 255px;" required>
                            <i class="fa fa-user-o icon"></i>
                            @if($errors->has('email'))
                                <p class="help-block has-error" style="position: absolute;">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <select name="group" id="input" class="form-control" required>
                            @foreach($groups as $group)
                                <option value="{{ $group->slug }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success pull-right">Invite</button>
                    </form>
                </div>
                <div class="team-members">
                    <h2>Members <span class="label label-default" style="margin-left: 16px; padding: 2px 7px;">{{ $members->count() }}</span></h2>
                    <div class="member-list">
                        @foreach($members as $member)
                            <div class="media member-list-item">
                                <a class="pull-left" href="#">
                                    @if(!$member->profile_image)
                                        <img class="media-object" style="border-radius: 3px;" src="/img/no-image.png" width="42" height="42" alt="Image">
                                    @else
                                        <img class="media-object" style="border-radius: 3px;" src="/img/avatars/{{ $member->profile_image }}" width="42" height="42" alt="Image">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <div class="pull-left user-info-con">
                                        <h4 class="media-heading member-name">
                                            <a href="#">{{ $member->first_name . ' ' . $member->last_name }}</a>
                                        </h4>
                                        <div class="text-muted" style="font-family: lato; font-size: 13px;"><i class="fa fa-envelope-o fa-fw"></i> {{ $member->email }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center">
                            {{ $members->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection