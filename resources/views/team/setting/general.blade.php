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
                    <h2>Team Name</h2>
                    <p class="text-muted action-info">
                        Renaming team name will also change the team URL and will render all bookmarks to team pages invalid.        
                    </p>
                    <form action="{{ route('teams.update', [ $team->slug ]) }}" method="POST" class="form-inline" role="form">
                        {{ method_field('patch') }}
                        <div class="form-group">
                            <input type="text" id="team-name" name="team_name" class="form-control" value="{{ $team->name }}" placeholder="Enter team name" required style="width: 295px;">
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Save</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="team-logo">
                    <h2>Team logo</h2>
                    <div class="media">
                        <div class="pull-left">
                            @if($team->team_logo)
                                <img src="/img/avatars/{{ $team->team_logo }}" alt="" width="155" height="155" class="media-object" style="border-radius: 3px;">
                            @else
                                <img src="/img/no-image.png" alt="" width="155" height="155" class="media-object" style="border-radius: 3px;">
                            @endif
                        </div>
                        <div class="media-body avatar-upload-form-con">
                            <form action="{{ route('teams.logo', [ $team->slug ]) }}" enctype="multipart/form-data" id="avatar-upload-form" method="POST">
                                <h3 class="heading">Upload new picture</h3> 
                                <div class="form-group">
                                    <label class="btn btn-default upload-btn" style="margin-bottom: 7px;">
                                        Browse file... 
                                        <input type="file" name="team_logo" id="team_logo" class="hide">
                                    </label>
                                    <p class="text-muted">The maximum file size allowed is 200KB.</p>
                                    <input type="hidden" id="x" name="x" />
                                    <input type="hidden" id="y" name="y" />
                                    <input type="hidden" id="w" name="w" />
                                    <input type="hidden" id="h" name="h" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="delete-team">
                    <h2>Delete Team</h2>
                    <p class="text-muted action-info">
                        Deleting this team will permanently delete all wikis and users in this account.
                    </p>
                    <form action="{{ route('teams.destroy', [ $team->slug ]) }}" method="POST" role="form">
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> Yes I understand, delete my account</button>
                    </form>
                </div>
			</div>
		</div>
	</div>
@endsection