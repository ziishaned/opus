@if($page->comments->count() > 0)
	<ul class="list-unstyled comment-list">
		@foreach($page->comments as $comment)
    		<li class="comment-item">
    			<div class="media">
    				<a class="pull-left" href="">
    					@if(empty($comment->user->profile_image))
                            <img src="/images/default.png" width="64" height="64" alt="Image" class="media-object img-rounded">
						@else
                            <img src="/images/profile-pics/{{ $comment->user->profile_image }}" width="64" height="64" alt="Image" class="media-object img-rounded">
						@endif
    				</a>
    				<div class="media-body">
    					<h4 class="media-heading no-stroke mb5">
    						<a href="{{ route('users.show', [$organization->slug, $comment->user->id, ]) }}" class="pull-left">{{ $comment->user->first_name .' '. $comment->user->last_name }}</a> 
    						<span class="pull-right" style="font-size: 12px; position: relative; top: 3px;"><i class="fa fa-clock-o fa-fw"></i>{{ $comment->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</span>
							<div class="clearfix"></div>
    					</h4>
    					<p style="line-height: 25px;">{{ $comment->content }}</p>
    					<div class="media-foot">
	    					<ul class="list-unstyled list-inline dot-divider actions">
	    						<li><a href="#"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
	    						<li>
									<a href="#" onclick="if(confirm('Are you sure you want to delete comment?')) {event.preventDefault(); document.getElementById('delete-comment').submit();}"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
                                    <form id="delete-comment" action="{{ route('comments.delete', [$organization->slug, $category->slug, $wiki->slug, $page->slug, $comment->id]) }}" method="POST" style="display: none;">
                                        {!! method_field('delete') !!}
                                        {!! csrf_field() !!}
                                    </form>
	    						</li>
	    					</ul>
    					</div>
    				</div>
    			</div>
    		</li>
    	@endforeach
	</ul>
@endif