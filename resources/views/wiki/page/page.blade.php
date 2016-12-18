@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<h4 style="position: relative;"><a href="{{ route('wikis.show', [$organization->slug, $wiki->slug ]) }}">{{ $wiki->name }}</a>
								<div class="dropdown" style="position: absolute; top: -5px; right: 0px;">
                                    <div class="btn-group" role="group">
                                        <a href="#" style="padding: 2px 5px; border: none; box-shadow: none;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-gear fa-lg"></i>
                                        </a>
                                    </div>
								</div>
								<div class="clearfix"></div>
							</h4>
							<p class="text-muted">Created by {{ $wiki->user->first_name }} on {{ $wiki->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $wiki->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }} </p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default" id="wiki-list-con">
			            <div class="panel-heading" style="background-color: #ffffff;">
                            <h3 class="panel-title" style="position: relative;">Page Tree <a href="{{ route('wikis.pages.create', [$organization->slug, $wiki->slug]) }}" class="btn btn-default" style="border: none; box-shadow: none;position: absolute; right: 0px; top: -3.6px; color: #333; font-size: 14px; padding: 2px 5px;"><i class="fa fa-file-text-o fa-fw"></i> Create</a></h3>
			            </div>
			        	<div class="panel-body" style="padding-left: 0px !important; padding-bottom: 10px; padding-right: 0px;">
			        		<input type="text" id="current-node" class="hide" value="{{ $page->id }}">
			        		<input type="text" id="current-page-id" class="hide" value="{{ $page->id }}">
							<div id="wiki-page-tree" style="margin-top: -7px;" data-wiki-id="{{ $wiki->id }}" data-organization-id="{{ $organization->id }}"></div>
			        	</div>
			        </div>
				</div>
			</div>
		</div>
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <ul class="nav nav-pills center-block" id="organization-nav" style="margin-bottom: 10px;">
                                    <li>
                                        <ol class="breadcrumb page-path" style="margin-bottom: 0;">
                                            @foreach($pagePath as $path)
                                                <li @if($page->id == $path->id) class="active"  @endif><a href="#">{{ $path->name }}</a></li>
                                            @endforeach
                                        </ol>
                                    </li>
                                    <ul class="nav nav-pills pull-right" id="organization-nav" style="border-bottom: 0px !important;">
                                        <li>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <div class="btn-group" role="group">
                                                    <button type="button" style="padding: 5px 10px; border: none; box-shadow: none;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-download fa-lg"></i> <i class="fa fa-caret-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                                                        <li><a href="#"><i class="fa fa-file-word-o"></i> Word Document</a></li>
                                                    </ul>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <button type="button" style="padding: 5px 10px; border: none; box-shadow: none;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="{{ route('pages.edit', [$organization->slug, $wiki->slug, $page->slug]) }}">Edit</a></li>
                                                        <li>
                                                            <a href="#" onclick="if(confirm('Are you sure you want to delete this page?')) {event.preventDefault(); document.getElementById('delete-page').submit();}">Delete</a>
                                                            <form id="delete-page" action="{{ route('pages.destroy', [$organization->slug, $wiki->slug, $page->slug]) }}" method="POST" style="display: none;">
                                                                {!! method_field('delete') !!}
                                                                {!! csrf_field() !!}
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
            </div>
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h4><a href="{{ route('wikis.pages.show', [$organization->slug, $wiki->slug, $page->slug]) }}">{{ $page->name }}</a></h4>
                        <p class="text-muted">Created by {{ $page->user->first_name }} {{ $page->user->last_name }} on {{ $page->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $page->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }} </p>
                    </div>
                </div>
			    	<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
			    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					    	<div class="page-description" style="min-height: 260px;">
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
																	<h6 class="comment-name by-author"><a href="{{ route('users.show', [$organization->slug, $comment->user->id, ]) }}">@if(empty($comment->user->first_name)) {{ $comment->user->name }} @else {{ $comment->user->first_name }} @endif</a></h6>
																	<ul class="list-unstyled list-inline pull-right">
																		<li><i class="fa fa-clock-o"></i> <time class="timeago" datetime="{{ $comment->created_at->timezone(Session::get('user_timezone')) }}">{{ $comment->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</time></li>
																		<li><a href="#" id="like-comment" data-commentid="{{ $comment->id }}"><i class="fa fa-heart"></i></a> <span id="comment-total-star" data-commentid="{{ $comment->id }}">{{ ViewHelper::getCommentStar($comment->id) }}</span></li>
		                                                                @if($comment->user->id == Auth::user()->id)
		                                                                    <li><a href="#" id="edit-comment" data-commentid="{{ $comment->id  }}"><i class="fa fa-pencil"></i></a></li>
		                                                                    <li>
		                                                                        <a href="#" onclick="if(confirm('Are you sure you want to delete comment?')) {event.preventDefault(); document.getElementById('delete-comment').submit();}"><i class="fa fa-trash-o"></i></a>
		                                                                        <form id="delete-comment" action="{{ route('comments.delete', [$organization->slug, $wiki->sug, $page->slug, $comment->id]) }}" method="POST" style="display: none;">
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
			    			<form action="{{ route('wikis.pages.comments.store', [$organization->slug, $page->wiki->slug, $page->slug]) }}" method="POST" id="comment-form" role="form" data-toggle="validator"> 
			    				<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
			    					<div class="row">
			    						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="padding-right: 0px;">
		                                    <a href="{{ route('users.show', [$organization->slug, Auth::user()->slug, ]) }}">
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
	</div>
@endsection