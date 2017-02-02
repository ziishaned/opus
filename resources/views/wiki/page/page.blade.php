@extends('layouts.app')

@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					@include('layouts.partials.wiki-side-menu')
				</div>
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			    	<div class="row affix-top" data-spy="affix" data-offset-top="10" style="width: 780px; background-color: #ffffff; z-index: 100;">
		                @include('layouts.partials.page-nav')
					</div>
					<div class="row">
					    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		              		<h3 class="mb5 marginless page-name"><a href="{{ route('pages.show', [$organization->slug, $category->slug, $wiki->slug, $page->slug]) }}">{{ $page->name }}</a></h3>
		                    <p class="text-muted">Created by {{ $page->user->first_name }} {{ $page->user->last_name }} on {{ $page->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $page->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }} </p>
			            </div>
			        </div>
			    	<div class="row">
			    		@if(str_word_count($page->description) > 0)
				    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						    	<div class="page-description">
						    		{!! $page->description !!}
						    	</div>
						    </div>
			    		@else 
							@include('layouts.partials.page-no-description') 
			    		@endif
					</div>
					<hr>
					@include('layouts.partials.comments-list')
					<hr>
					@include('layouts.partials.comment-input')
				</div>
			</div>
		</div>
	</section>
@endsection