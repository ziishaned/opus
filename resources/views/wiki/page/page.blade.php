@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    	@include('layouts.partials.page-nav')
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
												<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
													<div class="comment-avatar">
                                                        <a href="#">
	                                                        @if(empty($comment->user->profile_image))
	                                                            <img src="/images/default.png" width="64" height="64" class="img-responsive" alt="Image" style="border-radius: 3px;">
    														@else
	                                                            <img src="/images/profile-pics/{{ $comment->user->profile_image }}" width="64" height="64" class="img-responsive" alt="Image" style="border-radius: 3px;">
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
	    						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                    <a href="{{ route('users.show', [Auth::user()->slug, ]) }}">
	                                    @if(empty(Auth::user()->profile_image))
									        <img src="/images/default.png" width="64" height="64" class="img-responsive" alt="Image" style="border-radius: 3px;">
									    @else
									        <img src="/images/profile-pics/{{ Auth::user()->profile_image }}" width="64" height="64" class="img-responsive" alt="Image" style="border-radius: 3px;">
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
@endsection