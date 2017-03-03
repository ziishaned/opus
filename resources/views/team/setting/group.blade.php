@extends('layouts.master')

@section('content')
    <div class="team-setting">
        <div class="team-setting-header">
          Team Settings
        </div>
        <div role="tabpanel">
            @include('team.partials.tab-menu')
            <div class="tab-content">
                <div class="s-groups-con">
                    <div class="s-group-header">
                        <div class="header">
                            <div class="pull-left">
                                <h2>Current Groups</h2>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('groups.create', [ $team->slug ]) }}" class="btn btn-link create-group-btn"><i class="fa fa-plus fa-fw"></i> Create Group</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="s-groups-body">
                        <div class="panel panel-default s-group-item">
                            <div class="panel-body">
                                <div class="group-item-header">
                                    <div class="pull-left">
                                        <p class="group-name"><span class="name-inner">Administrators</span> <span class="label label-default">5</span></p> 
                                    </div>
                                    <div class="pull-right">
                                        <ul class="list-unstyled list-inline">
                                            <li><a href="#"><i class="fa fa-pencil fa-fw" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a></li>
                                            <li><a href="#"><i class="fa fa-trash-o fa-fw" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="group-members-con">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 group-member-item">
                                            <div class="media">
                                                <a class="pull-left group-member-img" href="#">
                                                    <img class="media-object" src="/img/christian.jpg" alt="Image" data-toggle="tooltip" data-placement="top" title="" data-original-title="Christian">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading group-member-name">Christian</h4>
                                                    <p class="grou-member-email">christian@gmail.com</p>
                                                </div>
                                            </div>      
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 group-member-item">
                                            <div class="media">
                                                <a class="pull-left group-member-img" href="#">
                                                    <img class="media-object" src="/img/elliot.jpg" alt="Image" data-toggle="tooltip" data-placement="top" title="" data-original-title="Elliot">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading group-member-name">Elliot</h4>
                                                    <p class="grou-member-email">elliot@gmail.com</p>
                                                </div>
                                            </div>      
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 group-member-item">
                                            <div class="media">
                                                <a class="pull-left group-member-img" href="#">
                                                    <img class="media-object" src="/img/helen.jpg" alt="Image" data-toggle="tooltip" data-placement="top" title="" data-original-title="Helen">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading group-member-name">Helen</h4>
                                                    <p class="group-member-email">helen@gmail.com</p>
                                                </div>
                                            </div>      
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 group-member-item">
                                            <div class="media">
                                                <a class="pull-left group-member-img" href="#">
                                                    <img class="media-object" src="/img/jenny.jpg" alt="Image" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jenny">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading group-member-name">Jenny</h4>
                                                    <p class="grou-member-email">jenny@gmail.com</p>
                                                </div>
                                            </div>      
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 group-member-item">
                                            <div class="media">
                                                <a class="pull-left group-member-img" href="#">
                                                    <img class="media-object" src="/img/joe.jpg" alt="Image" data-toggle="tooltip" data-placement="top" title="" data-original-title="joe">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading group-member-name">Joe</h4>
                                                    <p class="grou-member-email">joe@gmail.com</p>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection