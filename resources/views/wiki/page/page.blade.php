@extends('layouts.app')

@section('content')
	<div style="background-color: #f8f8f8; padding-top: 8px; border-bottom: 1px solid #E0E0E0;">
        <div class="container">
        	<div class="row">
        		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        			<div class="wiki-head">
	        			<h3 style="margin-bottom: 0;" class="wiki-name"><a href="{{ route('wikis.show', [$organization->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h3>
						<p style="margin-bottom: 0px;" class="text-muted">Created by {{ $wiki->user->first_name . ' ' . $wiki->user->last_name }} on {{ $wiki->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $wiki->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }}</p>
        			</div>
        		</div>
        		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			        <div class="navbar wiki-subnav" style="margin-bottom: 0;">
		        		<ul class="nav navbar-nav">
		        			<li>
		        				<a href="#">Overview</a>
		        			</li>
		        			<li>
		        				<a href="#">Permissions</a>
		        			</li>
		        			<li>
			                    <a href="{{ route('wikis.pages.reorder', [$organization->slug, $wiki->slug]) }}">Reorder pages</a>
			                </li>
			                <li style="position: relative; top: 10px;">
			                	<a href="{{ route('wikis.pages.create', [$organization->slug, $wiki->slug]) }}" class="btn btn-default" style="padding-top: 5px; padding-bottom: 5px;">Create page</a>
			                </li>
		        		</ul>
		                <ul class="nav navbar-nav navbar-right">
		        			<li>
		        				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <i class="fa fa-caret-down"></i></a>
				                <ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#">Delete</a></li>
				                </ul>
		        			</li>
		                </ul>
			        </div>
        		</div>
        	</div>
        </div>
    </div>
    <div class="container">
		<div class="row" style="margin-top: 20px;">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="panel panel-default" id="wiki-list-con">
		            <div class="panel-heading">Page Tree</div>
		        	<div class="panel-body" style="padding-left: 0px !important; padding-bottom: 10px; padding-right: 0px;">
						<div id="current-page-id" class="hide">{{ $page->id }}</div>
						<div id="wiki-page-tree" style="margin-top: -7px;" data-wiki-id="{{ $wiki->id }}" data-organization-id="{{ $organization->id }}" data-current-page="{{ $page->id }}"></div>
		        	</div>
		        </div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="row">
				    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	              		<ol class="breadcrumb page-path" style="margin-bottom: 0;">
                            @foreach($pagePath as $path)
                                <li @if($page->id == $path->id) class="active"  @endif><a href="#">{{ $path->name }}</a></li>
                            @endforeach
                        </ol>      
		            </div>
		        </div>
                <div class="row" style="margin-top: 12px;">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h4 class="page-name-head"><a href="{{ route('wikis.pages.show', [$organization->slug, $wiki->slug, $page->slug]) }}">{{ $page->name }}</a></h4>
                        <p class="text-muted">Created by {{ $page->user->first_name }} {{ $page->user->last_name }} on {{ $page->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $page->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }} </p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    	<div class="navbar page-subnav">
	                    	<ul class="nav navbar-nav navbar-right">
				    			<li><a href="{{ route('pages.edit', [$organization->slug, $wiki->slug, $page->slug]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
				    			<li><a href="#"><i class="fa fa-check-square-o"></i> Add to read list</a></li>
					            <li class="dropdown">
					                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i></a>
					                <ul class="dropdown-menu">	
					                    <li><a href="#"><i class="fa fa-info"></i> Page information</a></li>
					                    <li><a href="#"><i class="fa fa-history"></i> Page history</a></li>
					                    <li><a href="#"><i class="fa fa-html5"></i> Page source</a></li>
					                   	<li class="divider"></li>
					                    <li><a href="#"><i class="fa fa-file-pdf-o"></i> Export to PDF</a></li>
					                    <li><a href="#"><i class="fa fa-file-word-o"></i> Export to Word Document</a></li>
					                    <li class="divider"></li>
					                    <li>
					                    	<a href="#" onclick="if(confirm('Are you sure you want to delete wiki?')) {event.preventDefault(); document.getElementById('delete-page').submit();}"><i class="fa fa-trash-o"></i> Delete</a>
											<form id="delete-page" action="{{ route('pages.destroy', [$organization->slug, $wiki->slug, $page->slug]) }}" method="POST" style="display: none;">
				                                <input type="hidden" name="_method" value="delete">
				                            </form>
					                    </li>
					                </ul>
					            </li>
				    		</ul>
                    	</div>
                    </div>
                </div>
		    	<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
		    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				    	<div class="page-description" style="min-height: 245px;">
				    		@if(str_word_count($page->description) > 0)
					    		{!! $page->description !!}
				    		@else 
								<h3 class="nothing-found" style="position: absolute; top: 50%; left: 50%; margin-left: -120px; margin-top: -20px;">This page does not contain any description yet...</h3>
				    		@endif
				    	</div>
				    </div>
				</div>
				@if($page->comments->count() > 0)
			    	<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<hr>
							<div class="comments-container">
								<ul id="comments-list" class="comments-list">
									@foreach($page->comments as $comment)
										<li class="comment-item">
											<div class="comment-main-level">
												<div style="display: flex;">
													<div class="comment-avatar" style="margin-right: 15px;">
                                                        <a href="#">
	                                                        @if(empty($comment->user->profile_image))
	                                                            <img src="/images/default.png" width="64" height="64" alt="Image" style="border-radius: 3px;">
    														@else
	                                                            <img src="/images/profile-pics/{{ $comment->user->profile_image }}" width="64" height="64" alt="Image" style="border-radius: 3px;">
    														@endif
                                                        </a>
													</div>
													<div class="comment-box" style="width: 100%;">
														<div class="comment-head" style="padding: 0px 10px 0px 10px;">
															<h6 class="comment-name by-author"><a href="{{ route('users.show', [$organization->slug, $comment->user->id, ]) }}">{{ $comment->user->first_name .' '. $comment->user->last_name }}</a></h6>
															<ul class="list-unstyled list-inline pull-right">
																<li><i class="fa fa-clock-o"></i> <time class="timeago" datetime="{{ $comment->created_at->timezone(Session::get('user_timezone')) }}">{{ $comment->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }}</time></li>
                                                                @if($comment->user->id == Auth::user()->id)
                                                                    <li><a href="#" id="edit-comment" data-comment-id="{{ $comment->id  }}" data-organization-id="{{ $organization->id  }}" data-wiki-id="{{ $wiki->id  }}" data-page-id="{{ $page->id  }}"><i class="fa fa-pencil"></i></a></li>
                                                                    <li>
                                                                        <a href="#" onclick="if(confirm('Are you sure you want to delete comment?')) {event.preventDefault(); document.getElementById('delete-comment').submit();}"><i class="fa fa-trash-o"></i></a>
                                                                        <form id="delete-comment" action="{{ route('comments.delete', [$organization->slug, $wiki->slug, $page->slug, $comment->id]) }}" method="POST" style="display: none;">
                                                                            {!! method_field('delete') !!}
                                                                            {!! csrf_field() !!}
                                                                        </form>
                                                                    </li>
                                                                @endif
															</ul>
														</div>
														<div class="comment-content" style="padding: 10px 10px 10px 10px;">
                                                            {!! $comment->content !!}
														</div>
														<span class="hide" id="comment-fedit" data-commentId="{{ $comment->id }}">{{ $comment->content }}</span>
													</div>
												</div>
											</div>
										</li>
			    					@endforeach
								</ul>
							</div>
						</div>
					</div>
				@endif
				<hr>
				<div class="row" style="margin-bottom: 15px;">
		    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		    			<form action="{{ route('wikis.pages.comments.store', [$organization->slug, $page->wiki->slug, $page->slug]) }}" method="POST" id="comment-form" role="form" data-toggle="validator"> 
		    				<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
		    					<div class="row">
		    						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-input-con">
		    							<div style="display: flex;">
		                                    <a href="{{ route('users.show', [$organization->slug, Auth::user()->slug, ]) }}" style="margin-right: 15px;">
			                                    @if(empty(Auth::user()->profile_image))
											        <img src="/images/default.png" width="65" height="65" alt="Image" style="border-radius: 3px;">
											    @else
											        <img src="/images/profile-pics/{{ Auth::user()->profile_image }}" width="65" height="65" alt="Image" style="border-radius: 3px;">
											    @endif
		                                    </a>
											<textarea name="comment" id="comment-input" class="form-control" placeholder="Submit your comment.."></textarea>
											@if ($errors->has('comment'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('comment') }}</strong>
			                                    </span>
			                                @endif
		    							</div>
		    						</div>
		    					</div>
		    				</div>
		    				<div class="form-group">
			    				<input type="submit" class="btn btn-primary pull-right" id="submit-comment" value="Submit">
		    				</div>
		    				<div class="clearfix"></div>
		    			</form>
		    		</div>
		    	</div>
			</div>
		</div>
    </div>
@endsection