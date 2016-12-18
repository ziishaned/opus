@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			@include('layouts.partials.profile')
			<hr>
			@include('layouts.partials.contribution-graph')
			@include('layouts.partials.activity')
		</div>
	</div>
@endsection
