@extends('layouts.app')

@section('content')
	<div class="subnav" style="background-color: #f8f8f8; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                <li class="active">
                    <a href="{{ route('dashboard', [$organization->slug]) }}">All activities</a>
                </li>
                <li>
                    <a href="#">My activities</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
	    <div style="margin-bottom: 10px; margin-top: 10px; height: 50px;">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">Facebook</a>
                    </li>
                    <li class="active">
                        <a href="#">All activities</a>
                    </li>
                </ul>
            </div>
        </div>
	    <div class="row">   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('layouts.partials.activity')
            </div>
	    </div>
    </div>
@endsection
