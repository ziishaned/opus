
@extends('layouts.master')

@section('content')
	@include('partials.team-side-menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="page-header">Activities</div>
				@include('team.partials.activity')
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Recent Wikis
					</div>
					<div class="panel-body" style="padding: 0px 0px">
						@if($wikis->count() > 0)
							<ul class="list-unstyled recent-wikis-list side-menu-top" style="margin-top: 0;">
								@foreach($wikis as $wiki)
									<li class="item">
										<a href="{{ route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" style="position: relative;">
											<i class="fa fa-book fa-fw fa-lg icon"></i> {{ $wiki->name }}
											@if($wiki->likes->count()) 
												<div style="position: absolute; right: 10px; top: 5px; color: #c1c1c1;">
													<i class="fa fa-heart fa-fw"></i> {{ $wiki->likes->count() }}
												</div>
											@endif
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