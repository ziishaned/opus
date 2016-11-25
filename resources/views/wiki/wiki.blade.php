@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    	@include('layouts.partials.wiki-nav')
	    	<div class="row">
	    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    	<div class="page-description" style="padding-top: 10px;">
			    		{!! $wiki->description !!}
			    	</div>
			    </div>
			</div>
	    </div>
	</div>
@endsection