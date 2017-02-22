
@extends('layouts.master')

@section('content')
	@include('partials.team-side-menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="page-header">All activities</div>
				@include('team.partials.activity')
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Recent Wikis
					</div>
					<div class="panel-body" style="padding: 15px 0px">
						@if($wikis->count() > 0)
							<ul class="list-unstyled recent-wikis-list">
								@foreach($wikis as $wiki)
									<li class="item">
										<a href="{{ route('wikis.show', [$team->slug, $wiki->category->slug, $wiki->slug]) }}">
											<div class="media v-center">
												<div class="pull-left">
													<img class="media-object" src="/img/icons/basic_book.svg" width="24" height="24" alt="Image">
												</div>
												<div class="media-body">
													<p class="wiki-name">{{ $wiki->name }}</p>
												</div>
											</div>
										</a>
									</li>
								@endforeach
							</ul>
						@else 
							<h1 class="nothing-found side">No recent wikis</h1>
						@endif
					</div>
				</div>	
			</div>
		</div>
	</div>
@endsection