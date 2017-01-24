@extends('layouts.app')

@section('content')
	<div style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <div class="subnav">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                    <li>
                        <a href="{{ route('dashboard', [$organization->slug, ]) }}">All activities</a>
                    </li>
                    <li class="active">
                        <a href="{{ route('dashboard.user.activity', [$organization->slug, ]) }}">My activities</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 10px;">
	    <div class="row">   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('layouts.partials.activity')
            </div>
	    </div>
    </div>
@endsection
