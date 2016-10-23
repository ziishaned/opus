@extends('layouts.app')

@section('content')
	<div class="row">
	    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	    	<div>
		    	<div class="panel panel-default">
	                <div class="panel-heading" style="padding-top: 5px; padding-bottom: 5px;">
	                	<div class="row" style="display: flex; align-items: center;">
	                		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">	
			                    <h3 class="panel-title">{{ $page->wiki->name }}</h3>
	                		</div>
	                		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	                			<div class="dropdown">
								  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: none; border: none; outline: none;">
								    <i class="fa fa-gear fa-lg"></i> <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
								    <li><a href="{{ route('wikis.pages.reorder', $page->wiki->id) }}"><i class="fa fa-align-left"></i> Reorder Pages</a></li>
								    <li>
								    	<a href="#" onclick="event.preventDefault(); document.getElementById('delete-wiki').submit();"><i class="fa fa-trash-o"></i> Delete</a>
										<form id="delete-wiki" action="{{ route('wikis.destroy', $page->wiki->id) }}" method="POST" style="display: none;">
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
	                    <a href="{{ route('wikis.show', $page->wiki->slug) }}" class="list-group-item"><i class="fa fa-home"></i> Home</a>
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
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                	<div class="row">
	                		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			                    <h3 class="panel-title" style="margin-top: 4px;">Page Tree</h3>
	                		</div>
	                		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
	                			<a href="{{ route('wikis.pages.create', $page->wiki->id) }}" class="btn btn-success btn-xs">Create Page</a>
	                		</div>
	                	</div>
	                </div>
	                <div class="list-group" style="padding-top: 8px; padding-bottom: 8px;">
	                	@if($wikiPages->count() == 0)
		                	<li class="list-group-item" style="box-shadow: inset 0 0 10px rgba(0,0,0,0.05); background-color: #ffffff; text-align: center;">Nothing found</li>
		               	@else
		                    <div id="page-tree">
								<ul>
									{{ ViewHelper::makeWikiPageTree($wikiPages, $page->id) }}
								</ul>
							</div>
						@endif
	                </div>
	            </div>
	    	</div>
	    </div>
	    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	    	<div class="row">
		    	<div class="wiki-nav-con">
		    		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				        <ul class="nav nav-pills">
				            <li><a href="#">Pages</a></li>
					    </ul>
		    		</div>
		    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		    			<ul class="nav nav-pills navbar-right" style="margin-right: 10px;">
				            <li><a href="{{ route('pages.edit', [$page->wiki->id, $page->id]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
				            <li><a href="#"><i class="fa fa-clock-o"></i> Save for later</a></li>
				            <li><a href="#"><i class="fa fa-eye"></i> Watch</a></li>
				            <li class="dropdown">
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v fa-lg"></i></a>
		                        <ul class="dropdown-menu">
		                            <li><a href="#"><i class="fa fa-paperclip"></i> Attachments<span class="badge">0</span></a></li>
		                            <li><a href="#"><i class="fa fa-history"></i> Page History</a></li>
		                            <li><a href="#"><i class="fa fa-lock"></i> Privacy</a></li>
		                            <li class="divider"></li>
		                            <li><a href="#"><i class="fa fa-file-pdf-o"></i> Export to PDF</a></li>
		                            <li><a href="#"><i class="fa fa-exchange"></i> Export to Word</a></li>
		                            <li><a href="{{ route('pages.edit', [$page->wiki->id, $page->id]) }}"><i class="fa fa-file-word-o"></i> Import Word Document</a></li>
		                            <li class="divider"></li>
		                            <li><a href="{{ route('wikis.pages.reorder', $page->wiki->id) }}"><i class="fa fa-copy"></i> Copy</a></li>
		                            <li><a href="{{ route('wikis.pages.reorder', $page->wiki->id) }}"><i class="fa fa-arrows"></i> Move</a></li>
		                            <li>
										<a href="#" onclick="event.preventDefault(); document.getElementById('delete-page').submit();"><i class="fa fa-trash-o"></i> Delete</a>
										<form id="delete-page" action="{{ route('pages.destroy', [$page->wiki->id, $page->id]) }}" method="POST" style="display: none;">
		                                    {!! method_field('delete') !!}
		                                    {!! csrf_field() !!}
		                                </form>
		                            </li>
		                        </ul>
		                    </li>
				        </ul>	
		    		</div>
		    	</div>
	    	</div>
	    	<div class="clearfix"></div>
	    	<div class="row page-head">
	    		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    			<div class="well well-sm" style="margin-bottom: 0px; border-radius: 0; color: #fff; border: 1px solid transparent; box-shadow: 0 1px 1px rgba(0,0,0,.05); background-color: #555;">
		    			<div class="pull-left">
			    			<h3 style="margin: 0; margin-bottom: 5px;">{{ $page->name }}</h3>
		    				<p style="margin-bottom: 0;">Created by {{ ViewHelper::getUsername($page->user_id) }} <i class="fa fa-clock-o"></i> <time class="timeago" datetime="{{ $page->created_at }}">{{ $page->created_at->diffForHumans() }}</time></p>
		    			</div>
						<div class="pull-right" style="margin-top: 15px;">
		    				<ul class="list-unstyled list-inline">
			    				<li><a href="#" id="like-page" data-pageid="{{ $page->id }}"><i class="fa fa-heart"></i></a> <span id="page-total-star">{{ ViewHelper::getPageStar($page->id) }}</span></li>
			    				<li><i class="fa fa-commenting"></i> {{ $page->comments->count() }}</li>
			    			</ul>
		    			</div>
				    	<div class="clearfix"></div>
	    			</div>		
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
												<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
													<div class="comment-avatar">
														<img src="/images/default.png" class="img-responsive" alt="Image">
													</div>
												</div>
												<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
													<div class="comment-box">
														<div class="comment-head">
															<h6 class="comment-name by-author"><a href="http://creaticode.com/blog">{{ $comment->user->name }}</a></h6>
															<ul class="list-unstyled list-inline pull-right">
																<li><i class="fa fa-clock-o"></i> <time class="timeago" datetime="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</time></li>
																<li><a href="#" id="like-comment" data-commentid="{{ $comment->id }}"><i class="fa fa-heart"></i></a> <span id="comment-total-star" data-commentid="{{ $comment->id }}">{{ ViewHelper::getCommentStar($comment->id) }}</span></li>
															</ul>
														</div>
														<div class="comment-content">
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
	    						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
	    							<div style="border: 3px solid #FFF; border-radius: 4px; box-shadow: 0 1px 2px rgba(0,0,0,0.2);">
		    							<img src="/images/default.png" class="img-responsive" alt="Image">		
	    							</div>
	    						</div>
	    						<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
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