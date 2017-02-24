<div class="panel panel-default" style="margin-bottom: 0px;">
    <div class="panel-heading">
        <div class="pull-left">
            Comments
        </div>
        <div class="pull-right">
            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                <li>
                    <a href="#"><img src="/img/icons/basic_heart.svg" data-toggle="tooltip" data-placement="bottom" title="Like" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"></a> 3
                </li>
                <li>
                    <img src="/img/icons/basic_message_multiple.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> 7
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body wiki-comments-con">
        <div class="comments" style="height: 350px;">
            @if($wiki->comments->count() > 0)
                @foreach($wiki->comments as $comment)
                    <div class="comment">
                        <div class="media">
                            <div class="pull-left">
                                @if(!empty($comment->user->profile_image)) 
                                    <img class="media-object img-circle" src="/img/{{ $comment->user->profile_image }}" alt="Image" width="50" height="50">
                                @else
                                    <img class="media-object img-circle" src="/img/no-image.png" alt="Image" width="50" height="50">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading user-name"><a href="#">{{ $comment->user->first_name . ' ' . $comment->user->last_name }}</a> <small class="comment-time">{{ $comment->updated_at->diffForHumans() }}</small></h4>
                                <p>{!! (new Emoji)->render($comment->content) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else 
                <h1 class="nothing-found">
                    <img src="/img/icons/basic_elaboration_message_sad.svg" width="54" height="54"> Nothing found
                </h1>
            @endif
        </div>
        <div class="wiki-comment-form">
            <form action="{{ route('wikis.comments.store', [$team->slug, $category->slug, $wiki->slug]) }}" method="POST">    
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}" style="margin-bottom: 13px;">
                    <textarea name="comment" class="form-control" id="comment-input-textarea" placeholder="Write a comment"></textarea>
                    @if($errors->has('comment'))
                        <p class="help-block has-error" style="margin-bottom: 0; position: absolute;">{{ $errors->first('comment') }}</p>
                    @endif
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Submit">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>