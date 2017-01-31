@extends('layouts.app')

@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					@include('layouts.partials.wiki-side-menu')
				</div>
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			    	@include('layouts.partials.wiki-nav')
			    	<div class="row">
			    		@if(str_word_count($wiki->description) > 0)
				    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						    	<div class="page-description">
						    		{!! $wiki->description !!}
							    </div>
							</div>
			    		@else
			    			@include('layouts.partials.page-no-description') 
			    		@endif
					</div>
				</div>
			</div>
		</div>	
	</section>
@endsection