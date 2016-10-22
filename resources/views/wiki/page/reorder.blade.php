@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	    	<div class="panel panel-default">
                <div class="panel-heading" style="padding-top: 5px; padding-bottom: 5px;">
                	<div class="row" style="display: flex; align-items: center;">
                		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		                    <h3 class="panel-title">{{ $wiki->name }}</h3>                			
                		</div>
                		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                			<div class="dropdown">
							  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: none; border: none; outline: none;">
							    <i class="fa fa-gear fa-lg"></i> <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
							    <li><a href="#"><i class="fa fa-align-left"></i> Reorder Pages</a></li>
							    <li>
							    	<a href="#" onclick="event.preventDefault(); document.getElementById('delete-wiki').submit();"><i class="fa fa-trash-o"></i> Delete</a>
									<form id="delete-wiki" action="{{ route('wikis.destroy', $wiki->id) }}" method="POST" style="display: none;">
	                                    {!! method_field('delete') !!}
	                                    {!! csrf_field() !!}
	                                </form>
							    </li>
							  </ul>
							</div>	
                		</div>
                	</div>
                </div>
                <div class="list-group">
                    <a href="{{ route('wikis.show', $wiki->id) }}" class="list-group-item"><i class="fa fa-file-text-o"></i> Pages</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		                    <h3 class="panel-title" style="margin-top: 4px;">Wiki Shortcuts</h3>
                		</div>
                	</div>
                </div>
                <div class="list-group">
                	<li class="list-group-item" style="text-align: center;">Nothing found</li>
                </div>
            </div>
	    </div>
	    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	    	<div class="row">
		    	<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="margin-top: 4px;">Page Tree</h3>
        			<p class="text-muted" style="margin-bottom: 0;">You can move any page by dragging it to a new position in the tree. </p>
                </div>
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