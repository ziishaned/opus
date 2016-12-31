@extends('layouts.app')

@section('content')
    <div class="subnav" style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
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
    <div class="container">
        <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;" class="hidden-xs">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">Facebook</a>
                    </li>
                    <li>
                        <a href="#">Reports</a>
                    </li>
                    <li class="active">
                        <a href="#">Wikis</a>
                    </li>
                </ul>
            </div>
        </div>
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
                                <div class="form-group period-dropdown" style="width: 300px; margin-top: 11px; margin-left: 17px;">
                                    <label for="input" class="control-label">Select Period</label>
                                    <select name="" id="input" class="form-control" required="required">
                                        <option value="">Daily</option>
                                        <option value="">Weekly</option>
                                        <option value="">Monthly</option>
                                    </select>     
                                </div>
                                <div id="highchart-wikis" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>          
                    </div>
                    <div role="tabpanel" class="tab-pane" id="Contributions">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection