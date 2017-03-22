@extends('layouts.master')

@section('content')
	@include('partials.team-side-menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="page-header">
					<div class="pull-left">
						<i class="fa fa-tag fa-fw fa-lg icon"></i>  {{ $tag->name }}
					</div>
					<div class="pull-right">
						<div class="btn-group btn-group-sm">
							<a href="{{ route('tags.wikis', [$team->slug, $tag->slug ]) }}" class="btn btn-default active"><i class="fa fa-book fa-fw icon" style="font-size: 14px; top: 0px; color: #666;"></i> Wikis</a>
							<a href="{{ route('tags.pages', [$team->slug, $tag->slug ]) }}" class="btn btn-default"><i class="fa fa-file-text-o fa-fw icon" style="font-size: 14px; top: 0px; color: #666;"></i> Pages</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="wikis-list" data-tag="{{ $tag->name }}">
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