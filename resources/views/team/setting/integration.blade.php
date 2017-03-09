@extends('layouts.master')

@section('content')
	<div class="team-setting">
		<div class="team-setting-header">
		  Team Settings
		</div>
		<div role="tabpanel">
			@include('team.partials.tab-menu')
			<div class="tab-content">
                <div class="integration-content" style="margin-top: 40px;">
                    <div class="pull-left">                        
                        <div class="media">
                            <div class="pull-left" style="padding-right: 38px;">
                                <img class="media-object" src="/img/slack.png" alt="Image" width="52" height="52">
                            </div>
                            <div class="media-body" style="width: 590px;">
                                <h4 class="media-heading" style="font-size: 18px; font-weight: 700;">Slack</h4>
                                <p style="font-size: 15px;">A messaging app for teams</p>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('integration.slack', [$team->slug]) }}" class="btn btn-success" style="position: relative; top: 8px;"><i class="fa fa-plus-circle fa-fw"></i> Add</a>    
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="integration-list" style="margin-top: 28px;">
                    <h2 style="font-size: 19px; margin-bottom: 15px;">Integrations <span class="label label-default" style="padding: 1px 6px; margin-left: 20px;">{{ $integrations->count() }}</span></h2>
                    <div class="panel panel-default">
                        <ul class="list-group panel-body" style="margin-bottom: 0; padding: 0;">
                            @foreach($integrations as $integration)
                                <li class="list-group-item">    
                                    <div class="media">
                                        <div class="pull-left">
                                            <span class="integration-active media-object" data-toggle="tooltip" data-placement="top" title="Active" style="background-color: #5cb85c; width: 8px; height: 8px; display: inline-block; margin-right: 8px; border-radius: 50%; position: relative; top: -2px;"></span>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                <div class="pull-left">
                                                    <h4 class="media-heading">{{ $integration->title }}</h4>
                                                </div>
                                                <div class="pull-right">
                                                    <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                                        <li>
                                                            <a href="#">
                                                                <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil fa-fw" data-original-title="Edit"></i>
                                                            </a>
                                                        </li> 
                                                        <li>
                                                            <a href="#" data-method="delete" data-confirm="Are you sure?">
                                                                <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-trash-o fa-fw" data-original-title="Delete"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <p style="margin-bottom: 3px;"><a href="#">{{ $integration->url }}</a></p>
                                            <p class="text-muted">
                                                Created {{ $integration->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
			</div>
		</div>
	</div>
@endsection