@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    	<div class="row" style="margin-bottom: 10px;">
		    	<div class="wiki-nav-con">
		    		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
		    			<div class="row">
		    				<div class="pull-left" style="position: relative; top: 10px; left: 15px; margin-right: 5px;">
		    					<i class="fa fa-wikipedia-w fa-lg"></i> 
		    				</div>
		    				<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
				    			<h2 style="margin: 0; margin-bottom: 3px; font-size: 18px; margin-top: 10px; font-weight: normal;"><a href="#" style="color:#4078c0; font-weight: normal; text-transform: capitalize;">{{ $page->wiki->name }} / {{ $page->name }}</a></h2>
				    			<p style="margin-bottom: 0;" class="text-muted">Created by {{ ViewHelper::getUsername($page->user_id) }} on {{ $page->created_at->toFormattedDateString() }} at {{ $page->created_at->format('h:i A') }} </p>
		    				</div>
		    			</div>
		    		</div>
		    		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right" style="margin-top: 10px;">
		    			<ul class="list-inline list-unstyled" style="margin-bottom: 0px;">
		    				<li>
		    					<button type="submit" class="btn btn-default pull-left" style="border-radius: 3px 0px 0px 3px;">
							        <i class="fa fa-star-o"></i> Unstar
							    </button>
							    <div class="count-with-arrow pull-left">
									<span class="count star-count"> {{ ViewHelper::getWikiStar($page->slug) }} </span>
								</div>
								<div class="clearfix"></div>
		    				</li>
		    			</ul>
		    		</div>
		    	</div>
	    	</div>
	    	<div class="clearfix"></div>
	    	<div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        <ul class="nav nav-pills center-block" id="organization-nav" style="border-top: 1px solid #e5e5e5;">
			            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'wikis/{wiki_slug}') class="active" @endif>
			            	<a href="{{ route('wikis.show', $page->wiki->slug) }}"><i class="fa fa-home"></i> Home</a>
			            </li>
			            <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text-o"></i> Select Page <i class="fa fa-caret-down"></i></a>
	                        <ul class="dropdown-menu page-tree-con" style="left: -95px; top: 35px; width: 200px;">
	                            <div id="page-tree">
									<ul>
										{{ ViewHelper::makeWikiPageTree($wikiPages, $page->id) }}
									</ul>
								</div>
	                        </ul>
	                    </li>
			            <li>
			            	<a href="{{ route('wikis.pages.create', $page->wiki->slug) }}"><i class="fa fa-plus-square"></i> New Page</a>
			            </li>
	                    <li><a href="#"><i class="fa fa-sort fa-lg"></i> Reorder Pages</a></li>
	                    <ul class="nav nav-pills pull-right" id="organization-nav" style="border-bottom: 0px !important;">
				            <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download fa-lg"></i> <i class="fa fa-caret-down"></i></a>
		                        <ul class="dropdown-menu" style="left: -163px; top: 35px;">
		                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Export to PDF</a></li>
		                            <li><a href="#"><i class="fa fa-exchange"></i> Export to Word</a></li>
		                            <li><a href="#"><i class="fa fa-file-word-o"></i> Import Word Document</a></li>
		                        </ul>
		                    </li>
		                    <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear fa-lg"></i> <i class="fa fa-caret-down"></i></a>
		                        <ul class="dropdown-menu" style="left: -110px; top: 35px;">
		                            <li><a href="{{ route('pages.edit', [$page->wiki->id, $page->id]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
				                    <li>
				                    	<a href="#" onclick="event.preventDefault(); document.getElementById('delete-wiki').submit();"><i class="fa fa-trash-o"></i> Delete</a>
										<form id="delete-wiki" action="{{ route('wikis.destroy', $page->wiki->slug) }}" method="POST" style="display: none;">
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
			    	<div class="page-description" style="padding-left: 20px; padding-right: 20px;">
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
									<li>
										<div class="comment-main-level">
											<div class="row">
												<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
													<div class="comment-avatar">
                                                        <a href="#">
                                                            <img src="/images/default.png" width="64" height="64" class="img-responsive" alt="Image" style="border-radius: 3px;">
                                                        </a>
													</div>
												</div>
												<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
													<div class="comment-box">
														<div class="comment-head" style="padding: 0px 10px 0px 10px;">
															<h6 class="comment-name by-author"><a href="http://creaticode.com/blog">{{ $comment->user->name }}</a></h6>
															<ul class="list-unstyled list-inline pull-right">
																<li><i class="fa fa-clock-o"></i> <time class="timeago" datetime="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</time></li>
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
														<div class="comment-content" style="padding: 6px 10px 0px 10px;">
                                                            {!! $comment->content !!}
														</div>
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
                                    <a href="#">
                                        <img src="/images/default.png" width="64" height="64" class="img-responsive" alt="Image" style="border-radius: 3px;">
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