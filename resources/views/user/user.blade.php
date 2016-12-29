@extends('layouts.app')

@section('content')
	<div class="container">
		<div style="margin-bottom: 10px; margin-top: 10px; height: 50px;">
            <div class="site-breadcrumb">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0px;">
                    <li>
                        <a href="#">Facebook</a>
                    </li>
                    <li class="active">
                        <a href="#">{{ $user->first_name . ' ' . $user->last_name  }}</a>
                    </li>
                </ul>
            </div>
        </div>
		<div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
				@include('layouts.partials.profile')
			</div>
		    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
				@include('layouts.partials.activity')
			</div>
		</div>
	</div>
@endsection
