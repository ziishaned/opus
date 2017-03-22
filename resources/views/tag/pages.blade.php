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
							<a href="{{ route('tags.wikis', [$team->slug, $tag->slug ]) }}" class="btn btn-default"><i class="fa fa-book fa-fw" style="font-size: 14px; top: 0px; color: #666;"></i> Wikis</a>
							<a href="{{ route('tags.pages', [$team->slug, $tag->slug ]) }}" class="btn btn-default active"><i class="fa fa-file-text-o fa-fw" style="font-size: 14px; top: 0px; color: #666;"></i> Pages</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="wikis-list" data-tag="{{ $tag->name }}">
					@if($pages->count() > 0)
						<div class="list-group">
				            @foreach($pages as $page)
					            <a href="{{ route('pages.show', [$team->slug, $page->wiki->space->slug, $page->wiki->slug, $page->slug]) }}" class="list-group-item wikis-list-item" data-name="{{ $page->name }}">
					                <div class="media">
					                    <div class="pull-left">
					                        <i class="fa fa-file-text-o fa-fw fa-lg icon"></i>
					                    </div>
					                    <div class="media-body">
					                        <div class="wiki-top">
					                            <h4 class="media-heading">{{ $page->wiki->name . '/' . $page->name}}</h4>
					                        </div>
					                        <p class="wiki-item-description">{{ $page->outline }}</p>
					                        <div class="wiki-bottom">
					                        	<ul class="list-unstyled list-inline dot-divider" style="margin-bottom: 0;">
					                        		@if($page->likes->count())
						                        		<li style="color: #9c9c9c; font-size: 11px; font-weight: 500;">
						                        			<i class="fa fa-star fa-fw"></i> {{ $page->likes->count() }}
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
				        	{{ $pages->links() }}
				        </div>
				    @else 
						<h1 class="nothing-found side"><i class="fa fa-exclamation-triangle fa-fw icon"></i> Nothing found</h1>
				    @endif
				</div>
			</div>
		</div>
	</div>
@endsection