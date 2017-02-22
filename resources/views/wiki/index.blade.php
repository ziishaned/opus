@extends('layouts.master')

@section('content')
	@include('wiki.partials.menu')
	<div class="aside-content">
		<div class="row no-container">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="wiki-nav">
					<nav>
						<ul class="list-unstyled list-inline pull-left">
							<li>
								<a href="#"><img src="/img/icons/basic_eye.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Watch</a>
							</li>
							<li>
								<a href="#"><img src="/img/icons/basic_todo_txt.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Add to Read list</a>
							</li>
						</ul>
						<ul class="list-unstyled list-inline pull-right">
							<li>
								<a href="{{ route('wikis.edit', [$team->slug, $category->slug, $wiki->slug, ]) }}"><img src="/img/icons/software_pencil.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Edit</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/icons/basic_gear.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Settings</a>
								<ul class="dropdown-menu dropdown-menu-right" style="margin-top: 8px;">
			                        <li><a href="{{ route('wikis.create', [ $team->slug ]) }}">Create Wiki</a></li>
			                        <li><a href="{{ route('categories.create', [ $team->slug ]) }}">Create Category</a></li>
			                    </ul>
			              	</li>
						</ul>
						<div class="clearfix"></div>
					</nav>
				</div>
				<div class="formated-wiki-description">
					{!! $wiki->description !!}
				</div>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				@include('wiki.partials.comment')
			</div>
		</div>
	</div>
@endsection