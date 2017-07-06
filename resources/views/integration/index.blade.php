@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
            Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="tab-content">
                @if($integrations->count() === 0)
                    <div class="integration-content" style="margin-top: 40px;">
                        <div class="center-block">
                            {{-- <div class="text-center" style="margin-bottom: 40px;">
                                <img src="/img/slack-and-brand.png">
                            </div> --}}
                            <div style="width: 450px; text-align: center; margin: auto;">
                                <h2 style="margin-bottom: 15px; font-size: 2.7em;">Opus for Slack</h2>
                                <p style="font-size: 16px; margin-bottom: 18px;">Collaboration & communication combined. Link your Opus and Trello teams to build the ultimate productivity powerhouse.</p>
                                <a href="{{ route('integrations.create', [$team->slug]) }}" class="btn btn-default"><img src="/img/slack.png" width="26" height="26" style="margin-right: 8px;"> <span style="position: relative; top: 2px;">Add to Slack</span></a>
                            </div>
                        </div>
                    </div>
                @else
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
                                                                <a href="{{ route('integrations.edit', [$team->slug, $integration->slug]) }}">
                                                                    <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-pencil fa-fw" data-original-title="Edit"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('integrations.delete', [$team->slug, $integration->slug]) }}" data-method="delete" data-confirm="Are you sure?">
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
                @endif
            </div>
        </div>
    </div>
@endsection