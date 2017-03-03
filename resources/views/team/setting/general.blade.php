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
                            <input type="text" id="team-name" name="team_name" class="form-control" value="{{ $team->name }}" placeholder="Enter team name" required>
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Save</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="team-logo">
                    <h2>Upload Team logo</h2>
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label class="btn btn-default upload-btn">
                                Browse file... <input type="file" class="hide" name="profile_image" id="profile_image">
                            </label>
                            <button type="submit" class="btn btn-success pull-right">Upload</button>
                            <p class="text-muted no-stroke">The maximum file size allowed is 200KB.</p>
                        </div>
                    </form>
                </div>
                <div class="delete-team">
                    <h2>Delete Team</h2>
                    <p class="text-muted action-info">
                        Deleting this team will permanently delete all wikis and users in this account.
                    </p>
                    <form action="" method="POST" role="form">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> Yes I understand, delete my account</button>
                    </form>
                </div>
			</div>
		</div>
	</div>
@endsection