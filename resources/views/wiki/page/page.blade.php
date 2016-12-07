@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="panel panel-default" id="wiki-list-con">
	            <div class="panel-heading" style="background-color: #ffffff;">
	                <div class="row" style="border-bottom: 1px solid #d8d8d8;">
	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                        <h3 class="panel-title" style="margin-bottom: 10px;">Page Tree</h3>    
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                        <div class="form-group" style="margin-bottom: 0px; margin-top: 10px;">
	                            <input class="form-control input-sm fuzzy-search" id="searchinput" type="search" placeholder="Find a page..." />
	                            <span class="fa fa-search" style="position: absolute; top: 17px; right: 23px; color: #e7e9ed;"></span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        	<div class="panel-body" style="padding-left: 0px !important; padding-bottom: 10px;">
	        		<input type="text" id="current-page-id" class="hide" value="{{ $page->id }}">
					<div id="wiki-page-tree" style="margin-top: -7px;" data-wiki-id="{{ $wiki->id }}"></div>
	        	</div>
	        </div>
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			@include('layouts.partials.page-nav')
			<div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			    	<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						    <ul class="nav nav-pills center-block" id="organization-nav" style="border-top: 1px solid #e5e5e5; margin-top: 10px;">
						        <ul class="nav nav-pills pull-right" id="organization-nav" style="border-bottom: 0px !important;">
						            <li @if(ViewHelper::getCurrentRoute() == 'wikis/{wiki_slug}/pages/create') class="active" @endif>
							        	<a href="{{ route('wikis.pages.create', $wiki->slug) }}"><i class="fa fa-file-text-o"></i> Create</a>
							        </li>
						            <li><a href="{{ route('pages.edit', [$wiki->slug, $page->slug]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
						            <li class="dropdown">
						                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download fa-lg"></i> <i class="fa fa-caret-down"></i></a>
						                <ul class="dropdown-menu" style="left: -115px; top: 35px;">
											<li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
						                    <li><a href="#"><i class="fa fa-file-word-o"></i> Word Document</a></li>
						                </ul>
						            </li>
						            <li class="dropdown">
						                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i></a>
						                <ul class="dropdown-menu" style="left: -110px; top: 35px;">
						                    <li>
							                	<a href="{{ route('wikis.pages.reorder', $wiki->slug) }}">Reorder Pages</a>
							                </li>
							                <li class="divider"></li>
						                    <li>
						                    	<a href="#" onclick="if(confirm('Are you sure you want to delete this page?')) {event.preventDefault(); document.getElementById('delete-page').submit();}">Delete</a>
												<form id="delete-page" action="{{ route('pages.destroy', [$wiki->slug, $page->slug]) }}" method="POST" style="display: none;">
						                            {!! method_field('delete') !!}
						                            {!! csrf_field() !!}
						                        </form>
						                    </li>
						                </ul>
						            </li>
						        </ul>
						    </ul>
						</div>
					</div>
			    	<div class="row">
			    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					    	<div class="page-description" style="padding-top: 10px;">
					    		{!! $page->description !!}
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
													<div class="row">
														<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="padding-right: 0px;">
															<div class="comment-avatar">
		                                                        <a href="#">
			                                                        @if(empty($comment->user->profile_image))
			                                                            <img src="/images/default.png" width="64" height="64" alt="Image" style="border-radius: 3px;">
		    														@else
			                                                            <img src="/images/profile-pics/{{ $comment->user->profile_image }}" width="64" height="64" alt="Image" style="border-radius: 3px;">
		    														@endif
		                                                        </a>
															</div>
														</div>
														<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
															<div class="comment-box">
																<div class="comment-head" style="padding: 0px 10px 0px 10px;">
																	<h6 class="comment-name by-author"><a href="{{ route('users.show', [$comment->user->id, ]) }}">@if(empty($comment->user->full_name)) {{ $comment->user->name }} @else {{ $comment->user->full_name }} @endif</a></h6>
																	<ul class="list-unstyled list-inline pull-right">
																		<li><i class="fa fa-clock-o"></i> <time class="timeago" datetime="{{ $comment->created_at->timezone(Session::get('user_timezone')) }}">{{ $comment->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</time></li>
																		<li><a href="#" id="like-comment" data-commentid="{{ $comment->id }}"><i class="fa fa-heart"></i></a> <span id="comment-total-star" data-commentid="{{ $comment->id }}">{{ ViewHelper::getCommentStar($comment->id) }}</span></li>
		                                                                @if($comment->user->id == Auth::user()->id)
		                                                                    <li><a href="#" id="edit-comment" data-commentid="{{ $comment->id  }}"><i class="fa fa-pencil"></i></a></li>
		                                                                    <li>
		                                                                        <a href="#" onclick="if(confirm('Are you sure you want to delete comment?')) {event.preventDefault(); document.getElementById('delete-comment').submit();}"><i class="fa fa-trash-o"></i></a>
		                                                                        <form id="delete-comment" action="{{ route('comments.delete', $comment->id) }}" method="POST" style="display: none;">
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
			    			<form action="{{ route('wikis.pages.comments.store', [$page->wiki->slug, $page->slug]) }}" method="POST" id="comment-form" role="form" data-toggle="validator"> 
			    				<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}" style="margin-bottom: 0;">
			    					<div class="row">
			    						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="padding-right: 0px;">
		                                    <a href="{{ route('users.show', [Auth::user()->slug, ]) }}">
			                                    @if(empty(Auth::user()->profile_image))
											        <img src="/images/default.png" width="64" height="64" alt="Image" style="border-radius: 3px;">
											    @else
											        <img src="/images/profile-pics/{{ Auth::user()->profile_image }}" width="64" height="64" alt="Image" style="border-radius: 3px;">
											    @endif
		                                    </a>
			    						</div>
			    						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 comment-input-con">
											<textarea name="comment" id="comment-input" class="form-control" rows="5" placeholder="Submit your comment.."></textarea>
											@if ($errors->has('comment'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('comment') }}</strong>
			                                    </span>
			                                @endif
			    						</div>
			    					</div>
			    				</div>
			    				<div class="form-group" style="margin-top: 10px;">
				    				<input type="submit" class="btn btn-primary pull-right" id="submit-comment" value="Submit">
			    				</div>
			    				<div class="clearfix"></div>
			    			</form>
			    		</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
@endsection