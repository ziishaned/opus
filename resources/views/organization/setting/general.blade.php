@extends('layouts.app')

@section('content')
    <div class="team-general-setting">
        <div class="heading text-center">
            <h1>Team Settings</h1>
        </div>
        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="{{ route('organizations.settings.general', [$organization->slug]) }}">General</a>
                </li>
                <li role="presentation">
                    <a href="{{ route('organizations.settings.members', [$organization->slug]) }}"">Members</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="team-info">
                    <h2>Team Name</h2>
                    <p class="text-muted action-info">
                        Renaming company name will also change the Company URL and will render all bookmarks to company pages invalid.        
                    </p>
                    <form action="" method="POST" class="form-inline" role="form">
                        <div class="form-group">
                            <label class="sr-only" for="">Team Name</label>
                            <input type="email" class="form-control" value="{{ $organization->name }}" placeholder="Input field">
                        </div>
                        <button type="submit" class="save-team-info pull-right">Save</button>
                    </form>
                </div>
                <div class="team-logo">
                    <h2>Upload Team logo</h2>
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label class="btn btn-default upload-btn">
                                Browse file... <input type="file" class="hide" name="profile_image" id="profile_image">
                            </label>
                            <button type="submit" class="upload-team-logo pull-right">Upload</button>
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
