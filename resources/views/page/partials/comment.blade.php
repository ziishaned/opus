<div class="panel panel-default" style="margin-bottom: 20px; border: 1px solid #eee;">
    <div class="panel-heading" style="background-color: #fbfbfb; border-bottom: 1px solid #eee;">
        <div class="pull-left">
            Comments
        </div>
        <div class="pull-right">
            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                <li class="page-like-con">
                    <i class="fa fa-spinner fa-spin fa-lg fa-fw" id="spinner"></i>
                    <a href="#" id="like-page" data-page="{{ $page->slug }}"><i class="fa fa-star-o fa-fw" style="font-size: 16px;" data-toggle="tooltip" data-placement="top" title="{{ $isUserLikePage ? 'Unlike' : 'Like' }}" style="margin-right: 2px;"></i></a> <span class="label label-default" id="likes-counter" style="padding: 3px 8px; font-weight: 400; display: inline-flex; align-items: center; font-size: 11px;">{{ $page->likes->count() }}</span>
                </li>
                <li>
                    <i class="fa fa-comments-o fa-fw" style="margin-right: 2px; font-size: 16px;"></i> <span class="label label-default" style="padding: 3px 8px; font-weight: 400; display: inline-flex; align-items: center; font-size: 11px;">{{ $page->comments->count() }}</span>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body wiki-comments-con">
        <div class="comments">
            @if($page->comments->count() > 0)
                @foreach($page->comments as $comment)
                    <div class="comment" data-comment-id="{{ $comment->id }}">
                        <div class="media">
                            <div class="pull-left profile-image-con">
                                @if(!empty($comment->user->profile_image)) 
                                    <img class="media-object img-rounded profile-image" src="/img/avatars/{{ $comment->user->profile_image }}" alt="Image" width="44" height="44">
                                @else
                                    <img class="media-object img-rounded profile-image" src="/img/no-image.png" alt="Image" width="44" height="44">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading user-name"><a href="{{ route('users.show', [ $team->slug, $comment->user->slug ]) }}">{{ $comment->user->first_name . ' ' . $comment->user->last_name }}</a> <small class="comment-time" data-toggle="tooltip" data-placement="bottom" title="{{ $comment->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $comment->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}">{{ $comment->updated_at->diffForHumans() }}</small></h4>
                                <div class="comment-body-con">
                                    <div class="comment-body-inner">
                                        <div class="comment-body">
                                            <p class="comment-content" data-comment-content="{{ html_entity_decode(strip_tags($comment->content), null, 'utf-8') }}">{!! (new Emoji)->render($comment->content) !!}</p>
                                        </div>
                                        <div class="comment-actions">
                                            <ul class="list-unstyled list-inline">
                                                <li>
                                                    <?php $userLikeComment = false; ?>
                                                    @foreach($comment->likes as $like)
                                                        @if($like->user_id === Auth::user()->id)
                                                            <?php $userLikeComment = true; ?>
                                                        @endif
                                                    @endforeach
                                                    <i class="fa fa-spinner fa-spin fa-lg fa-fw" id="spinner"></i> <a href="#" id="like-comment" data-comment-id="{{ $comment->id }}"><i class="fa fa-thumbs-up fa-fw"></i> {{ $userLikeComment ? 'Unlike' : 'Like' }}</a>
                                                    <span class="label label-default" style="display: inline-block; padding: 3px 5px;" id="comment-like-counter">{{ $comment->likes->count() }}</span>
                                                </li>
                                                @if($comment->user_id === Auth::user()->id)
                                                    <li>
                                                        <a href="#" id="edit-comment"><i class="fa fa-pencil fa-fw"></i> Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" id="delete-comment" data-comment-id="{{ $comment->id }}"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
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
    </div>
</div>
<div class="wiki-comment-form">
    <form action="{{ route('pages.comments.store', [$team->slug, $space->slug, $wiki->slug, $page->slug]) }}" method="POST">    
        <div class="media">
            <div class="pull-left" style="padding-right: 15px;">
                <img class="media-object profile-image" src="/img/no-image.png" alt="Image" width="44" height="44" style="border-radius: 3px;">
            </div>
            <div class="media-body">
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}" style="margin-bottom: 13px;">
                    <textarea name="comment" class="form-control" id="comment-input-textarea" placeholder="Write a comment"></textarea>
                    @if($errors->has('comment'))
                        <p class="help-block has-error" style="width: 230px; margin-bottom: 0; position: absolute;">{{ $errors->first('comment') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-success pull-right" value="Submit">
        <div class="clearfix"></div>
    </form>
</div>