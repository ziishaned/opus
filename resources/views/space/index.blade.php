@extends('layouts.master')

@section('content')
	@include('partials.team-side-menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="page-header">
					<div class="pull-left">
						{{ $space->name }}
					</div>
					<div class="pull-right">
						<a href="{{ route('wikis.create', [$team->slug]) }}" class="btn btn-link" style="color: #000;"><i class="fa fa-plus fa-fw"></i> Create Wiki</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="wikis-list" data-space="{{ $space->name }}">
					@if($wikis->count() > 0)
						<div class="list-group">
				            @foreach($wikis as $wiki)
					            <a href="{{ route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug]) }}" class="list-group-item wikis-list-item" data-name="{{ $wiki->name }}">
					                <div class="media">
					                    <div class="pull-left">
					                        <i class="fa fa-book fa-fw fa-lg icon"></i>
					                    </div>
					                    <div class="media-body">
					                        <div class="wiki-top">
					                            <h4 class="media-heading">{{ $wiki->name}}</h4>
					                        </div>
					                        <p class="wiki-item-description">{{ $wiki->outline }}</p>
					                        <div class="wiki-bottom">
					                        	<ul class="list-unstyled list-inline dot-divider" style="margin-bottom: 0;">
					                        		<li>
							                        	<div class="item-category-label" data-space="{{ $wiki->space->name }}">{{ $wiki->space->name }}</div>
					                        		</li>
					                        		@if($wiki->likes->count())
						                        		<li style="color: #9c9c9c; font-size: 11px; font-weight: 500;">
						                        			<i class="fa fa-star fa-fw"></i> {{ $wiki->likes->count() }}
						                        		</li>
						                        	@endif
					                        	</ul>
					                        </div>
					                    </div>
					                </div>  
					            </a>
					        @endforeach
				        </div>
				        <div class="text-center">
				        	{{ $wikis->links() }}
				        </div>
				    @else 
						<h1 class="nothing-found side"><i class="fa fa-exclamation-triangle fa-fw icon"></i> Nothing found</h1>
				    @endif
				</div>
			</div>
		</div>
	</div>
@endsection