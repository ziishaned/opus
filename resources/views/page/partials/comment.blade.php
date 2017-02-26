<div class="panel panel-default" style="margin-bottom: 0px;">
    <div class="panel-heading">
        <div class="pull-left">
            Comments
        </div>
        <div class="pull-right">
            <ul class="list-unstyled list-inline" style="margin-bottom: 0;">
                <li class="page-like-con">
                    <i class="fa fa-spinner fa-spin fa-lg fa-fw" id="spinner"></i>
                    <a href="#" id="like-page" data-page="{{ $page->slug }}"><img src="/img/icons/basic_heart.svg" data-toggle="tooltip" data-placement="bottom" title="{{ $isUserLikePage ? 'Unlike' : 'Like' }}" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"></a> <span id="likes-counter">{{ $page->likes->count() }}</span>
                </li>
                <li>
                    <img src="/img/icons/basic_message_multiple.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> {{ $page->comments->count() }}
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body wiki-comments-con">
        <div class="comments" style="height: 350px;">
            @if($page->comments->count() > 0)
                @foreach($page->comments as $comment)
                    {{-- <div class="comment">
                        <div class="media">
                            <div class="pull-left">
                                @if(!empty($comment->user->profile_image)) 
                                    <img class="media-object img-circle" src="/img/{{ $comment->user->profile_image }}" alt="Image" width="50" height="50">
                                @else
                                    <img class="media-object img-circle" src="/img/no-image.png" alt="Image" width="50" height="50">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading user-name"><a href="{{ route('users.show', [ $team->slug, $comment->user->slug ]) }}">{{ $comment->user->first_name . ' ' . $comment->user->last_name }}</a> <small class="comment-time" data-toggle="tooltip" data-placement="bottom" title="{{ $comment->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $comment->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}">{{ $comment->updated_at->diffForHumans() }}</small></h4>
                                <p>{!! (new Emoji)->render($comment->content) !!}</p>
                            </div>
                        </div>
                    </div> --}}
                    <div class="comment" data-comment-id="{{ $comment->id }}">
                        <div class="media">
                            <div class="pull-left profile-image-con">
                                @if(!empty($comment->user->profile_image)) 
                                    <img class="media-object img-rounded profile-image" src="/img/{{ $comment->user->profile_image }}" alt="Image" width="44" height="44">
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
                                                    <span class="label label-default" style="display: inline-block;" id="comment-like-counter">{{ $comment->likes->count() }}</span> <i class="fa fa-spinner fa-spin fa-lg fa-fw" id="spinner"></i> <a href="#" id="like-comment" data-comment-id="{{ $comment->id }}">{{ $userLikeComment ? 'Unlike' : 'Like' }}</a>
                                                </li>
                                                @if($comment->user_id === Auth::user()->id)
                                                    <li>
                                                        <a href="#" id="edit-comment">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" id="delete-comment" data-comment-id="{{ $comment->id }}">Delete</a>
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
        <div class="wiki-comment-form">
            <form action="{{ route('pages.comments.store', [$team->slug, $category->slug, $wiki->slug, $page->slug]) }}" method="POST">    
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}" style="margin-bottom: 13px;">
                    <textarea name="comment" class="form-control" id="comment-input-textarea" placeholder="Write a comment"></textarea>
                    @if($errors->has('comment'))
                        <p class="help-block has-error" style="width: 230px; margin-bottom: 0; position: absolute;">{{ $errors->first('comment') }}</p>
                    @endif
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Submit">
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>