<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="media mb20">
			<a class="pull-left" href="#">
				@if(empty(Auth::user()->profile_image))
			        <img src="/images/default.png" width="64" height="64" alt="Image" class="media-object img-rounded">
			    @else
			        <img src="/images/profile-pics/{{ Auth::user()->profile_image }}" width="64" height="64" alt="Image" class="media-object img-rounded">
			    @endif
			</a>
			<div class="media-body">
				<form action="{{ route('comments.store', [$organization->slug, $category->slug, $wiki->slug, $page->slug]) }}" method="POST" id="comment-form" role="form"> 
    				<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
						<textarea name="comment" class="form-control input" rows="3" placeholder="Submit your comment.."></textarea>
						@if ($errors->has('comment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
    				</div>
    				<input type="submit" class="btn btn-primary pull-right" id="submit-comment" value="Submit">
    			</form>
			</div>
		</div>
	</div>
</div>