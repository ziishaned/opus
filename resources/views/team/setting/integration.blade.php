@extends('layouts.master')

@section('content')
	<div class="team-setting">
		<div class="team-setting-header">
		  Team Settings
		</div>
		<div role="tabpanel">
			@include('team.partials.tab-menu')
			<div class="tab-content">
                <div class="integration-content" style="margin-top: 50px;">
                    <div class="pull-left">                        
                        <div class="media">
                            <div class="pull-left" style="padding-right: 38px;">
                                <img class="media-object" src="/img/slack.png" alt="Image" width="62" height="62">
                            </div>
                            <div class="media-body" style="width: 590px;">
                                <h4 class="media-heading" style="font-size: 18px; font-weight: 700;">Slack</h4>
                                <p style="font-size: 15px;">A messaging app for teams</p>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('integration.slack', [$team->slug]) }}" class="btn btn-success" style="position: relative; top: 5px;"><i class="fa fa-plus-circle"></i> Add</a>    
                    </div>
                    <div class="clearfix"></div>
                    {{-- <form action="" method="POST" role="form" style="margin-top: 40px;">
                        <div class="form-group">
                            <div class="row v-center">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">    
                                    <label for="">Title</label>
                                </div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <input type="text" class="form-control" id="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row v-center">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">    
                                    <label for="">URL</label>
                                </div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <input type="text" class="form-control" id="">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        <div class="clearfix"></div>
                    </form> --}}
                </div>
			</div>
		</div>
	</div>
@endsection