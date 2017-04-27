@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
            Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="tab-content">
                <div class="integration-content" style="width: 400px; margin: auto; margin-top: 32px;">
                    <div class="media">
                        <div class="pull-left" style="padding-right: 38px;">
                            <img class="media-object" src="/img/slack.png" alt="Image" width="62" height="62">
                        </div>
                        <div class="media-body" style="width: 590px;">
                            <h4 class="media-heading" style="font-size: 18px; font-weight: 700;">Slack</h4>
                            <p style="font-size: 15px;">A messaging app for teams</p>
                        </div>
                    </div>
                    <form action="{{ route('integrations.update', [$team->slug, $integration->slug]) }}" method="POST" role="form" style="margin-top: 20px; margin-bottom: 20px;">
                        {{ method_field('patch') }}
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="integration-title" class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $integration->title }}" id="integration-title">
                            @if($errors->has('title'))
                                <p class="help-block has-error">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                            <label for="integration-url" class="control-label">URL</label>
                            <input type="text" name="url" class="form-control" value="{{ $integration->url }}" id="integration-url">
                            @if($errors->has('url'))
                                <p class="help-block has-error">{{ $errors->first('url') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Receive Notifications</label>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label style="width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Wiki</label>
                                    <div class="checkbox" style="margin-top: 0;">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="1" {{ in_array('1', old('integrations', [])) || in_array('wiki_created', $integrationActions) ? 'checked' : '' }} >
                                            Created
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="2" {{ in_array('2', old('integrations', [])) || in_array('wiki_updated', $integrationActions) ? 'checked' : '' }}>
                                            Updated
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="3" {{ in_array('3', old('integrations', [])) || in_array('wiki_deleted', $integrationActions) ? 'checked' : '' }}>
                                            Deleted
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label style="width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Page</label>
                                    <div class="checkbox" style="margin-top: 0;">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="4" {{ in_array('4', old('integrations', [])) || in_array('page_created', $integrationActions) ? 'checked' : '' }}>
                                            Created
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="5" {{ in_array('5', old('integrations', [])) || in_array('page_updated', $integrationActions) ? 'checked' : '' }}>
                                            Updated
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="6" {{ in_array('6', old('integrations', [])) || in_array('page_deleted', $integrationActions) ? 'checked' : '' }}>
                                            Deleted
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label style="width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Comment</label>
                                    <div class="checkbox" style="margin-top: 0;">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="7" {{ in_array('7', old('integrations', [])) || in_array('comment_created', $integrationActions) ? 'checked' : '' }}>
                                            Created
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="8" {{ in_array('8', old('integrations', [])) || in_array('comment_updated', $integrationActions) ? 'checked' : '' }}>
                                            Updated
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="9" {{ in_array('9', old('integrations', [])) || in_array('page_deleted', $integrationActions) ? 'checked' : '' }}>
                                            Deleted
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label style="width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 5px;">More</label>
                                    <div class="checkbox" style="margin-top: 0;">
                                        <label>
                                            <input type="checkbox" name="integrations[]" value="10" {{ in_array('10', old('integrations', [])) || in_array('wiki_created', $integrationActions) || in_array('join_team', $integrationActions) ? 'checked' : '' }}>
                                            Someone join team
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Save Configuration</button>
                        <a href="{{ route('integrations.index', [$team->slug]) }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection