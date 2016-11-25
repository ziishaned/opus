@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			@include('layouts.partials.wiki-nav')		
			<div class="row">
			    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <h3 class="panel-title" style="margin-top: 10px; color: #555 !important;">Page Tree</h3>
        			<p class="text-muted" style="margin-bottom: 0;">You can move any page by dragging it to a new position in the tree. </p>
	                <div class="list-group" style="padding-top: 8px; padding-bottom: 8px;">
	                	@if($wikiPages->count() == 0)
		                	<li class="list-group-item" style="background-color: #ffffff; text-align: center;">Nothing found</li>
		               	@else
		                    <div id="page-tree">
								<ul>
									{{ ViewHelper::makeWikiPageTree($wikiPages, null) }}
								</ul>
							</div>
						@endif
	                </div>
			    </div>
			</div>
		</div>
	</div>
@endsection