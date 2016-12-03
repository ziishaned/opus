@extends('layouts.app')

@section('content')
    @include('layouts.partials.profile')        
    @include('layouts.partials.user-nav')
    @include('layouts.partials.contribution-graph')
    <div class="row" style="margin-top: 15px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @include('layouts.partials.activity')
        </div>
    </div>
@endsection
