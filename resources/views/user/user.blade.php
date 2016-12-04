@extends('layouts.app')

@section('content')
	<div class="row">
	    @include('layouts.partials.user-nav')
	    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		    @include('layouts.partials.profile')
		    <hr>        
		    @include('layouts.partials.contribution-graph')
            @include('layouts.partials.activity')
	    </div>
	</div>
@endsection
