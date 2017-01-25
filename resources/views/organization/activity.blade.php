@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row">   
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="dashboard-sidebar" data-spy="affix" data-offset-top="27">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-clock-o"></i> Recent wikis</div>
                        <div class="panel-body">
                            <ul class="list-unstyled" style="margin-bottom: 0;">
                                <li class="text-center">This organization does not have any recent wikis...</li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-star-o"></i> Favourite wikis</div>
                        <div class="panel-body">
                            <ul class="list-unstyled" style="margin-bottom: 0;">
                                <li class="text-center">Fovourite list is empty...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <h2 style="margin-bottom: 23px; position: relative; top: 5px;">All Updates</h2>
                <hr>
                @include('layouts.partials.activity')
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="dashboard-aside dashboard-quick-links" data-spy="affix" data-offset-top="27">
                    <div class="section-head" style="margin-top: 10px; margin-bottom: 15px;">
                        Quick links
                    </div>
                    <hr>
                    <div class="section-body text-center">
                        <ul class="list-inline list-unstyled"> 
                            <li>
                                <button type="button" class="btn btn-default">Create wiki</button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-default">Create category</button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-success">Invite users</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
	    </div>
    </div>
@endsection
