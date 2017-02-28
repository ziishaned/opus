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
								<a href="#"><img src="/img/icons/basic_elaboration_todolist_check.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Add to Read list</a>
							</li>
							<li>
								<a href="#"><img src="/img/icons/software_paragraph_space_after.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Insert into Shortcut</a>
							</li>
						</ul>
						<ul class="list-unstyled list-inline pull-right">
							<li>
								<a href="{{ route('wikis.edit', [$team->slug, $category->slug, $wiki->slug, ]) }}"><img src="/img/icons/software_pencil.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Edit</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/img/icons/basic_gear.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Settings</a>
								<ul class="dropdown-menu dropdown-menu-right" style="margin-top: 8px;">
			                        <li><a href="#"><i class="fa fa-info-circle fa-fw"></i> Page Overview</a></li>
			                        <li><a href="#"><i class="fa fa-history fa-fw"></i> Page History</a></li>
									<li class="divider"></li>
									<li><a href="#"><i class="fa fa-file-pdf-o fa-fw"></i> Export to PDF</a></li>
			                        <li><a href="#"><i class="fa fa-file-word-o fa-fw"></i> Export to Word</a></li>
									<li class="divider"></li>
									<li>
										<a href="#" onclick="if(confirm('Are you sure you want to delete wiki?')) {event.preventDefault(); document.getElementById('delete-wiki').submit();}"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
										<form id="delete-wiki" action="{{ route('wikis.destroy', [$team->slug, $wiki->category->slug, $wiki->slug]) }}" method="POST" class="hide">
											{!! method_field('delete') !!}
											{!! csrf_field() !!}
										</form>
									</li>
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