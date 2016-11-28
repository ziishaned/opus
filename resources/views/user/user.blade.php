@extends('layouts.app')

@section('content')
    @include('layouts.partials.profile')        
    @include('layouts.partials.contribution-graph')
    @include('layouts.partials.user-nav')
    <div class="row" style="margin-top: 15px;">
        <div class="col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @include('layouts.partials.activity')
                </div>
            </div>
        </div>
    </div>
@endsection
