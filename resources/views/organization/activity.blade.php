@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">   
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="dashboard-sidebar" data-spy="affix" data-offset-top="10">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-clock-o"></i> Recent wikis</div>
                            <div class="panel-body">
                                <ul class="list-unstyled marginless">
                                    <li class="text-center">This organization does not have any recent wikis...</li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-star-o"></i> Favourite wikis</div>
                            <div class="panel-body">
                                <ul class="list-unstyled marginless">
                                    <li class="text-center">Fovourite list is empty...</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div data-spy="affix" data-offset-top="10" style="background-color: #ffffff; z-index: 10; width: 360px;">
                        <h2 style="margin-bottom: 23px; margin-top: 0; position: relative; top: 5px;">All Updates</h2>
                        <hr style="margin: 0;">
                    </div>
                    @include('layouts.partials.activity')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="dashboard-aside dashboard-quick-links" data-spy="affix" data-offset-top="10">
                        <div class="section-head">
                            <h2 style="margin-top: 6px; margin-bottom: 17px;">Quick links</h2>
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
    </section>
@endsection
