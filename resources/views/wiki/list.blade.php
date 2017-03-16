@extends('layouts.master')

@section('content')
	<div class="side-menu hidden-sm hidden-xs">
		<div class="side-menu-inner">
			<ul class="list-unstyled side-menu-top">
				<li class="item {{ (Route::currentRouteName() == 'teams.wikis' ? 'active' : '') }}">
					<a href="{{ route('teams.wikis', [$team->slug]) }}">
						<img src="/img/icons/basic_notebook.svg" width="24" height="24" class="icon">
						<span class="item-name">All wikis</span>
					</a>
				</li>
			</ul>
			<div class="side-menu-wiki-list">
				<ul class="list-unstyled" id="categories-list">
					<li class="nav-header">Categories</li>
					@if($categories->count() > 0)
						@foreach($categories as $category)
							<li class="item" id="categories-list-item" data-name="{{ $category->name }}">
				                <a href="{{ route('categories.wikis', [$team->slug, $category->slug, ]) }}">
				                    <div class="cateogry-icon" style="margin-right: 13px; position: relative; top: 1px;"></div>
									<span class="item-name">{{ $category->name }}</span>
									@if($category->wikis->count())
										<span style="color: #c1c1c1; margin-left: auto; margin-right: 2px;">{{ $category->wikis->count() }}</span>
									@endif
				                </a>
				            </li>
			           @endforeach
			        @else
			           <li class="text-center text-muted" style="margin-top: 15px; font-size: 13px;">Nothing found...</li>
			        @endif
				</ul>
			</div>
		</div>
	</div>
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="wikis-list-inner">
					<div class="pull-left">
						<h1 class="wikis-list-header">All Wikis</h1>
					</div>
					<div class="pull-right">
						<form action="" method="POST" role="form" class="form-inline">
							<div class="form-group with-icon">
								<input type="text" class="form-control" placeholder="Filter by name" id="" style="width: 250px;">
								<i class="fa fa-search icon"></i>
							</div>
						</form>	
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="wikis-list">
					@if($wikis->count() > 0)
						<div class="list-group">
				            @foreach($wikis as $wiki)
					            <a href="" class="list-group-item wikis-list-item" data-name="{{ $wiki->name }}">
					                <div class="media">
					                    <div class="pull-left">
					                        <img class="media-object" src="/img/icons/basic_notebook.svg" alt="Image" width="19" height="19">
					                    </div>
					                    <div class="media-body">
					                        <div class="wiki-top">
					                            <h4 class="media-heading">{{ $wiki->name}}</h4>
					                        </div>
					                        <p class="wiki-item-description">{{ $wiki->outline }}</p>
					                        <div class="wiki-bottom">
					                        	<ul class="list-unstyled list-inline dot-divider" style="margin-bottom: 0;">
					                        		<li>
							                        	<div class="item-category-label">{{ $wiki->category->name }}</div>
					                        		</li>
					                        		@if($wiki->likes->count())
						                        		<li style="color: #c1c1c1;">
						                        			<i class="fa fa-heart fa-fw"></i> {{ $wiki->likes->count() }}
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
						<h1 class="nothing-found">Nothing found</h1>
				    @endif
				</div>
			</div>
		</div>
	</div>
@endsection