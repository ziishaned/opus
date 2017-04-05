@if($wiki->comments->count() > 0)
    <div class="panel panel-default" style="margin-bottom: 20px; border: 1px solid #eee;">
        <div class="panel-heading" style="background-color: #fbfbfb; border-bottom: 1px solid #eee;">
            <div class="pull-left">
                Comments
            </div>
            <div class="pull-right">
                <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                    <li class="page-like-con">
                        <i class="fa fa-star-o fa-fw" style="font-size: 16px;" style="margin-right: 2px;"></i> <span class="label" id="likes-counter" style="color: #9c9c9c; font-size: 12px; font-weight: 600; padding: 0px; margin-left: 2px;">{{ $wiki->likes->count() }}</span>
                    </li>
                    <li>
                        <i class="fa fa-comments-o fa-fw" style="margin-right: 2px; font-size: 16px;"></i> <span class="label" style="color: #9c9c9c; font-size: 12px; font-weight: 600; padding: 0px; margin-left: 2px;">{{ $wiki->comments->count() }}</span>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body wiki-comments-con">
            <div class="comments">
                @if($wiki->comments->count() > 0)
                    @foreach($wiki->comments as $comment)
                        <div class="comment" data-comment-id="{{ $comment->id }}">
                            <div class="media">
                                <div class="pull-left profile-image-con">
                                    @if(!empty($comment->user->profile_image)) 
                                        <img class="media-object profile-image" src="/img/avatars/{{ $comment->user->profile_image }}" alt="Image" width="44" height="44">
                                    @else
                                        <img class="media-object profile-image" src="/img/no-image.png" alt="Image" width="44" height="44">
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading user-name">
                                        <a href="{{ route('users.show', [ $team->slug, $comment->user->slug ]) }}">
                                            {{ $comment->user->name }}
                                        </a> 
                                        <small class="comment-time" style="font-size: 12px; margin-left: 15px; color: rgba(0,0,0,.4);">{{ $comment->updated_at->diffForHumans() }}</small>
                                        <small id="comment-like-counter" style="margin-left: 15px; font-size: 12px; color: rgba(0,0,0,.4);"><i class="fa fa-star fa-fw"></i> {{ $comment->likes->count() }}</small>
                                    </h4>
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
                                                        <i class="fa fa-spinner fa-spin fa-lg fa-fw" id="spinner"></i> <a href="#" id="like-comment" data-comment-id="{{ $comment->id }}"><i class="fa fa-thumbs-o-up fa-fw" style="font-size: 14px;"></i> {{ $userLikeComment ? 'Unlike' : 'Like' }}</a>
                                                    </li>
                                                    @if($comment->user_id === Auth::user()->id)
                                                        <li>
                                                            <a href="#" id="edit-comment"><i class="fa fa-pencil fa-fw" style="font-size: 14px;"></i> Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" id="delete-comment" data-comment-id="{{ $comment->id }}"><i class="fa fa-trash-o fa-fw" style="font-size: 14px;"></i> Delete</a>
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
                    <h1 class="nothing-found">Nothing found</h1>
                @endif
            </div>
        </div>
    </div>
@endif
<div class="wiki-comment-form">
    <form action="{{ route('wikis.comments.store', [$team->slug, $space->slug, $wiki->slug]) }}" method="POST">    
        <div class="media">
            <div class="pull-left" style="padding-right: 15px;">
                @if(!empty(Auth::user()->profile_image)) 
                    <img class="media-object" src="/img/avatars/{{ Auth::user()->profile_image }}" alt="Image" width="44" height="44" style="border-radius: 3px;">
                @else
                    <img class="media-object" src="/img/no-image.png" alt="Image" width="44" height="44" style="border-radius: 3px;">
                @endif
            </div>
            <div class="media-body">
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}" style="margin-bottom: 0px;">
                    <textarea name="comment" class="form-control" id="comment-input-textarea" placeholder="Write a comment" style="margin-bottom: 13px;"></textarea>
                    @if($errors->has('comment'))
                        <p class="help-block has-error" style="width: 230px; margin-bottom: 0; position: absolute;">{{ $errors->first('comment') }}</p>
                    @endif
                    <button type="submit" class="btn btn-primary pull-right" style="border-radius: 3px;">Submit</button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </form>
</div>