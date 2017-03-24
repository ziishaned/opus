@extends('layouts.master')

@section('content')
	@include('partials.team-side-menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="page-header"><i class="fa fa-check-square-o fa-fw fa-lg icon"></i> Read List</div>
				<div class="wikis-list">
					@if($readList->count() > 0)
						<div class="list-group">
				            @foreach($readList as $item)
					            <a href="{{ $item->subject_type === 'App\Models\Wiki' ? route('wikis.show', [$team->slug, $item->subject->space->slug, $item->subject->slug]) : route('pages.show', [$team->slug, $item->subject->wiki->space->slug, $item->subject->wiki->slug, $item->subject->slug]) }}" class="list-group-item wikis-list-item">
					                <div class="media">
					                    <div class="pull-left">
					                        @if($item->subject_type === 'App\Models\Wiki')
					                    		<i class="fa fa-book fa-lg fa-fw icon"></i>    
					                    	@else
					                    		<i class="fa fa-file-text-o fa-lg fa-fw icon"></i>    
					                    	@endif
					                    </div>
					                    <div class="media-body">
					                        <div class="wiki-top">
					                        	<div class="pull-left">
						                            <h4 class="media-heading">{{ $item->subject->name}}</h4>
					                        	</div>
					                        	<div class="pull-right" style="margin-right: 15px;">
					                        		@if($item->subject_type === 'App\Models\Wiki')
						                        		<object><a href="{{ route('wikis.readlater.destroy', [$team->slug, $item->subject->space->slug, $item->subject->slug]) }}" data-method="delete" data-toggle="tooltip" data-placement="top" title="Remove from Read List"><i class="fa fa-trash-o icon"></i></a></object>
						                        	@else
						                        		<object><a href="{{ route('pages.readlater.destroy', [$team->slug, $item->subject->wiki->space->slug, $item->subject->wiki->slug, $item->subject->slug]) }}" data-method="delete" data-toggle="tooltip" data-placement="top" title="Remove from Read List"><i class="fa fa-trash-o icon"></i></a></object>
						                        	@endif
					                        	</div>
					                        	<div class="clearfix"></div>
					                        </div>
					                        <p class="wiki-item-description">{{ $item->subject->outline }}</p>
					                        <div class="wiki-bottom">
					                        	<ul class="list-unstyled list-inline dot-divider" style="margin-bottom: 0;">
					                        		@if($item->subject_type === 'App\Models\Wiki')
						                        		<li>
								                        	<div class="item-category-label" data-space="{{ $item->subject->space->name }}">{{ $item->subject->space->name }}</div>
						                        		</li>
						                        	@else 
														<li>
								                        	<div class="item-category-label" data-space="{{ $item->subject->wiki->space->name }}">{{ $item->subject->wiki->space->name }}</div>
						                        		</li>
						                        	@endif
					                        		@if($item->subject->likes->count())
						                        		<li style="color: #9c9c9c; font-size: 11px; font-weight: 500;">
						                        			<i class="fa fa-star fa-fw"></i> {{ $item->subject->likes->count() }}
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
				        	{{ $readList->links() }}
				        </div>
					@else
						<h1 class="nothing-found side"><i class="fa fa-exclamation-triangle fa-fw icon"></i> Nothing found</h1>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection