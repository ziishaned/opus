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
			<div class="side-menu-wiki-list side-menu-categories-list">
				<ul class="list-unstyled">
					<li class="nav-header">All categories</li>
					<aside-category-list team="{{ $team->slug }}" category="{{ $category->slug }}"></aside-category-list>
				</ul>
			</div>
		</div>
	</div>
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="wikis-list-inner">
					<div class="pull-left">
						<h1 class="wikis-list-header">{{ $category->name }} wikis</h1>
					</div>
					<div class="pull-right">
						<form action="" method="POST" role="form" class="form-inline">
							<div class="form-group with-icon">
								<input type="text" class="form-control" id="" style="width: 250px;">
								<i class="fa fa-search icon"></i>
							</div>
						</form>	
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="wikis-list">
					<wikis-list team="{{ $team->slug }}" category="{{ $category->slug }}"></wikis-list>
				</div>
			</div>
		</div>
	</div>
@endsection