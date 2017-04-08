@if($activities->count() > 0)
    <div class="events-list">
        @foreach($activities as $activity)
            <div class="media event">
                <a class="pull-left event-user-image" href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}">
                    @if(!empty($user->profile_image)) 
                        <img class="media-object" style="border-radius: 3px;" src="/img/avatars/{{ $user->profile_image }}" width="44" height="44" alt="Image">
                    @else
                        <img class="media-object" style="border-radius: 3px;" src="/img/no-image.png" width="44" height="44" alt="Image">
                    @endif
                </a>
                <div class="media-body">
                    <div class="event-top">
                        <div class="pull-left event-icon">
                            @if($activity->name == 'created_space')
                                <i class="fa fa-tag fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'deleted_space')
                                <i class="fa fa-trash-o fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'updated_space')
                                <i class="fa fa-save fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'created_wiki')
                                <i class="fa fa-book fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'deleted_wiki')
                                <i class="fa fa-trash-o fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'updated_wiki')
                                <i class="fa fa-save fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'created_page')
                                <i class="fa fa-file-text-o fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'deleted_page')
                                <i class="fa fa-trash-o fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'updated_page')
                                <i class="fa fa-save fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'created_comment')
                                <i class="fa fa-comment-o fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'deleted_comment')
                                <i class="fa fa-trash-o fa-fw fa-lg icon"></i>
                            @endif

                            @if($activity->name == 'updated_comment')
                                <i class="fa fa-save fa-fw fa-lg icon"></i>
                            @endif
                        </div>
                        <div class="pull-left">
                            @if($activity->name == 'created_space')
                                You created space <a href="{{ route('spaces.wikis', [$team->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.
                            @endif
                            
                            @if($activity->name == 'deleted_space')
                                You deleted space <a href="{{ route('spaces.wikis', [$team->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.
                            @endif

                            @if($activity->name == 'updated_space')
                                You updated space <a href="{{ route('spaces.wikis', [$team->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.
                            @endif

                            @if($activity->name == 'created_wiki')
                                You created wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->space->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.
                            @endif

                            @if($activity->name == 'deleted_wiki')
                                You deleted wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->space->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.
                            @endif

                            @if($activity->name == 'updated_wiki')
                                You updated wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->space->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.
                            @endif

                            @if($activity->name == 'created_page')
                                You created page <a href="{{ route('pages.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                            @endif

                            @if($activity->name == 'deleted_page')
                                You deleted page <a href="{{ route('pages.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                            @endif

                            @if($activity->name == 'updated_page')
                                You updated page <a href="{{ route('pages.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject['name'] }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                            @endif

                            @if($activity->name == 'created_comment')
                                @if($activity->subject->subject_type === 'App\Models\Wiki')
                                    You commented on wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                                @else
                                    You commented on page <a href="{{ route('pages.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug, $activity->subject->page->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.
                                @endif
                            @endif

                            @if($activity->name == 'deleted_comment')
                                @if($activity->subject->subject_type === 'App\Models\Wiki')
                                    You deleted comment from wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                                @else
                                    You deleted comment from page <a href="{{ route('pages.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug, $activity->subject->page->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.
                                @endif
                            @endif

                            @if($activity->name == 'updated_comment')
                                @if($activity->subject->subject_type === 'App\Models\Wiki')
                                    You updated comment on wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                                @else
                                    You updated comment on page <a href="{{ route('wikis.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="{{ route('pages.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug, $activity->subject->page->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.
                                @endif
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @if($activity->name == 'created_comment' || $activity->name == 'deleted_comment' || $activity->name == 'updated_comment')
                        <p style="padding: 2px 11px; margin-bottom: 5px; margin-top: 10px; border-left: 2px solid #eee;">{!! (new Emoji)->render($activity->subject->content) !!}</p>
                    @endif
                    <p class="text-muted">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</p>
                </div>
            </div>
        @endforeach
        <div class="text-center">
            {{ $activities->links() }}
        </div>
    </div>
@else 
    <h1 class="nothing-found side"><i class="fa fa-exclamation-triangle fa-fw icon"></i> Nothing found</h1>
@endif