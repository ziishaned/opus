@extends('layouts.app')

@section('content')
	<div class="container" style="margin-top: 20px;">
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
