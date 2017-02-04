@extends('layouts.app')

@section('content')
    <section>
        {{-- <div>
            <div class="container">
                <div class="subnav" >
                    <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                        <li class="active">
                            <a href="{{ route('dashboard', [$organization->slug, ]) }}">Wikis</a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.user.activity', [$organization->slug, ]) }}">Members</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <div class="container" style="margin-top: 20px;">
            <div class="row" style="margin-bottom: 20px;">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#Visits" aria-controls="Visits" role="tab" data-toggle="tab">Visits</a>
                        </li>
                        <li role="presentation">
                            <a href="#Contributions" aria-controls="Contributions" role="tab" data-toggle="tab">Contributions</a>
                        </li>
                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Visits">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group period-dropdown hidden-xs" style="position: absolute; right: 15px; z-index: 100; top: -45px;">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-default active">Daily</button>
                                            <button type="button" class="btn btn-default">Weekly</button>
                                            <button type="button" class="btn btn-default">Monthly</button>
                                        </div>
                                    </div>
                                    <div class="form-group period-dropdown text-center hidden-sm hidden-lg hidden-md" style="margin: 0; position: relative; top: 12px;">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-default active">Daily</button>
                                            <button type="button" class="btn btn-default">Weekly</button>
                                            <button type="button" class="btn btn-default">Monthly</button>
                                        </div>
                                    </div>
                                    <div id="highchart-wikis" style="margin-top: 12px; min-width: 310px; height: 400px;"></div>
                                </div>
                            </div>          
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Contributions">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
