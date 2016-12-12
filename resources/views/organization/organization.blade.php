@extends('layouts.app')

@section('content')
    <div class="row">   
        @include('layouts.partials.organization-nav')
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <h2>All activities</h2>
            <hr>
            {{-- @include('layouts.partials.activity') --}}
        </div>
    </div>
@endsection
