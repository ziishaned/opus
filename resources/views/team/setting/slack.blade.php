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
                    <form action="" method="POST" role="form" style="margin-top: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">URL</label>
                            <input type="text" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">Receive Notifications</label>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label style="width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Wiki</label>
                                    <div class="checkbox" style="margin-top: 0;">
                                        <label>
                                            <input type="checkbox" value="">
                                            Created
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Updated
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Deleted
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label style="width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Page</label>
                                    <div class="checkbox" style="margin-top: 0;">
                                        <label>
                                            <input type="checkbox" value="">
                                            Created
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Updated
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Deleted
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label style="width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Comment</label>
                                    <div class="checkbox" style="margin-top: 0;">
                                        <label>
                                            <input type="checkbox" value="">
                                            Created
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Updated
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">
                                            Deleted
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <label style="width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 5px;">More</label>
                                    <div class="checkbox" style="margin-top: 0;">
                                        <label>
                                            <input type="checkbox" value="">
                                            Someone join team
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Save Configuration</button>
                        <button type="submit" class="btn btn-link">Cancel</button>
                    </form>
                </div>
			</div>
		</div>
	</div>
@endsection