@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
          Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="tab-content">
                <div class="team-members team-groups-con">
                    <div class="current-groups-head">
                        <div class="pull-left">
                            <h2 style="margin-bottom: 0; position: relative; top: 7px;">Current Groups</h2>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('groups.create', [$team->slug,]) }}" class="btn btn-link"><i class="fa fa-plus fa-fw"></i> Create group</a>   
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel panel-default administrators-list team-group-list">
                        <div class="panel-body">
                            <div class="panel-top">
                                <div class="list-heading pull-left">
                                    <a href="#">Administrators</a> <div class="label label-default">5</div> 
                                </div> 
                                <div class="pull-right">
                                    <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                                        <li style="margin-bottom: 0;">
                                            <a href="#" class="btn btn-default btn-sm"><img src="/img/icons/software_pencil.svg" width="16" height="16"></a>
                                        </li>
                                        <li style="margin-bottom: 0;">
                                            <a href="#" class="btn btn-default btn-sm"><img src="/img/icons/basic_trashcan.svg" width="16" height="16"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div> 
                            <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/christian.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Christian">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Christian</h4>
                                            <a href="#">christian@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/elliot.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Elliot">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Elliot</h4>
                                            <a href="#">elliot@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/helen.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Helen">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Helen</h4>
                                            <a href="#">helen@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/jenny.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Jenny">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Jenny</h4>
                                            <a href="#">jenny@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/joe.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Joe">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Joe</h4>
                                            <a href="#">joe@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default administrators-list team-group-list">
                        <div class="panel-body">
                            <div class="panel-top">
                                <div class="list-heading pull-left">
                                    <a href="#">IT</a>
                                </div> 
                                <div class="list-total label label-default pull-right">5</div> 
                                <div class="clearfix"></div>
                            </div> 
                            <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/justen.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Justen">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Justen</h4>
                                            <a href="#">justen@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/laura.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Laura">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Laura</h4>
                                            <a href="#">laura@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/matt.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Matt">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Matt</h4>
                                            <a href="#">matt@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/steve.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Steve">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Steve</h4>
                                            <a href="#">steve@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <a class="pull-left" href="#" style="padding-right: 15px;">
                                            <img src="/img/stevie.jpg" class="media-object" data-toggle="tooltip" data-placement="bottom" title="Stevie">
                                        </a>
                                        <div class="media-body" style="width: 180px;">
                                            <h4 class="media-heading">Stevie</h4>
                                            <a href="#">stevie@gmail.com</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection