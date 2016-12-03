@if($activities->count() > 0)
    <div class="activity-list">
        @foreach($activities as $activity)
            <div class="activity">
                <div class="activity-con">
                    <div class="activity-icon pull-left">
                        @if($activity->log_type == 'delete')
                            <i class="fa fa-trash-o"></i>
                        @elseif($activity->log_type == 'watch') 
                            <i class="fa fa-eye"></i>
                        @elseif($activity->log_type == 'commented')
                            <i class="fa fa-commenting-o"></i>
                        @elseif($activity->log_type == 'following') 
                            <i class="fa fa-meh-o"></i>
                        @elseif($activity->log_type == 'star') 
                            <i class="fa fa-star-o"></i>
                        @else
                            <i class="fa fa-file-text-o"></i>
                        @endif
                    </div>
                    <div class="activity-content">
                        <a href="{{ route('users.show', [$activity->user_slug, ]) }}" title="{{ $activity->full_name }}">{{ $activity->full_name }}</a> 
                        @if($activity->log_type == 'create') 
                            created
                        @elseif($activity->log_type == 'update') 
                            updated a
                        @elseif($activity->log_type == 'commented')
                            commented on 
                        @elseif($activity->log_type == 'delete')
                            deleted
                        @elseif($activity->log_type == 'star')
                            starred
                        @elseif($activity->log_type == 'watch')
                            started watching
                        @elseif($activity->log_type == 'following')
                            following
                        @endif
                        {{ $activity->log_params['subject_type'] }} 
                        @if($activity->log_params['subject_type'] == 'comment') 
                            @if($activity->log_type == 'delete')
                                from 
                            @else
                                on
                            @endif
                            page <a href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('wikis.pages.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                        @else 
                            <a href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('wikis.pages.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                        @endif
                        @if($activity->log_params['subject_type'] == 'page' || $activity->log_params['subject_type'] == 'comment') 
                            at wiki 
                            <a href="{{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ]) }}" title="{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}">{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}</a>
                        @endif
                    </div>
                    <div class="time">
                        <i class="fa fa-clock-o"></i> <span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $activity->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}"><time class="timeago" datetime="{{ $activity->created_at->timezone(Session::get('user_timezone')) }}">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</time></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row text-center" style="margin-top: 15px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            {{ $activities->links() }}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="color: #777777; text-align: center; padding: 15px 0px 15px 0px; margin: 0;">Nothing found...</h3>
        </div>
    </div>
@endif