@extends('layouts.master')

@section('content')
	@include('wiki.partials.menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="page-header">All activities</div>
                @include('wiki.partials.activity')
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				@include('wiki.partials.comment')
			</div>	
		</div>
	</div>
@endsection