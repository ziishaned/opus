@if($activities->count() > 0)
    @foreach($activities as $activity)
        <div class="create simple" style="padding: 0 0 1em 45px; border-top: 1px solid #f1f1f1;">
            <div style="padding: 1em 0 0; overflow: hidden; font-size: 14px; border-bottom: 0;">
                <div class="simple">
                    @if($activity->log_type == 'delete')
                        <i class="fa fa-trash-o" style="color: #bbb;"></i>
                    @elseif($activity->log_type == 'watch') 
                        <i class="fa fa-eye" style="color: #bbb;"></i>
                    @elseif($activity->log_type == 'commented')
                        <i class="fa fa-commenting-o" style="color: #bbb;"></i>
                    @elseif($activity->log_type == 'following') 
                        <i class="fa fa-meh-o" style="color: #bbb;"></i>
                    @elseif($activity->log_type == 'star') 
                        <i class="fa fa-star-o" style="color: #bbb;"></i>
                    @else
                        <i class="fa fa-file-text-o" style="color: #bbb;"></i>
                    @endif
                    <div style="padding: 0; display: inline-block; font-size: 13px; font-weight: normal; color: #666;">
                        <a style="color: #4078c0; text-decoration: none;" href="{{ route('users.show', [ViewHelper::getUserSlug($activity->user_id), ]) }}" title="{{ ViewHelper::getFullName($activity->user_id) }}">{{ ViewHelper::getFullName($activity->user_id) }}</a> 
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
                            page <a style="color: #4078c0; text-decoration: none;" href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('wikis.pages.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                        @else 
                            <a style="color: #4078c0; text-decoration: none;" href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('wikis.pages.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                        @endif
                        @if($activity->log_params['subject_type'] == 'page' || $activity->log_params['subject_type'] == 'comment') 
                            at wiki 
                            <a style="color: #4078c0; text-decoration: none;" href="{{ route('wikis.show', [ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ]) }}" title="{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}">{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}</a>
                        @endif
                    </div>
                    <div class="time" style="display: inline-block; font-size: 12px; color: #bbb; cursor: default;">
                        <i class="fa fa-clock-o"></i> <span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->toFormattedDateString() . ' at ' . $activity->created_at->format('h:i A')}}"><time class="timeago" datetime="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</time></span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row text-center" style="margin-top: 15px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            {{ $activities->links() }}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 style="font-size: 17px; font-weight: 600; color: #777777; text-align: center; padding: 5px 0px 15px 0px; margin: 0; margin-top: 0px;"><i class="fa fa-search"></i> Nothing found...</h3>
        </div>
    </div>
@endif