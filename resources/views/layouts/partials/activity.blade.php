@if(count($activities) > 0)
    <ul class="messages" style="padding: 0; list-style: none;">
        @foreach($activities as $activity)
            <li style="border-bottom: 1px dotted #e6e6e6; padding: 8px 0; padding-bottom: 15px; padding-top: 15px;">
                <?php $profile_image = ViewHelper::getProfilePic($activity->user_id); ?> 
                <img src="/images/profile-pics/{{ $profile_image }}" class="img-responsive avatar hidden-xs hidden-sm" alt="Avatar" style="height: 75px; width: 75px; float: left; display: inline-block; border-radius: 3px; margin-right: 25px;">
                <div class="message_date" style="float: right; text-align: right; color: #31708f;">
                    <i class="fa fa-clock-o"></i> <span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $activity->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}"><time class="timeago" datetime="{{ $activity->created_at->timezone(Session::get('user_timezone')) }}">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</time></span>
                </div>
                <div class="message_wrapper">
                    <h3 class="heading" style="font-weight: 600; margin: 0; cursor: pointer; margin-bottom: 12px; line-height: 100%;">{{ $activity->first_name .' '. $activity->last_name }}</h3>
                    <div class="message">
                        @if($activity->log_type == 'delete')
                            <i class="fa fa-trash-o fa-lg" style="margin-right: 5px;"></i>
                        @elseif($activity->log_type == 'commented')
                            <i class="fa fa-commenting-o fa-lg" style="margin-right: 5px;"></i>
                        @else
                            <i class="fa fa-file-text-o fa-lg" style="margin-right: 5px;"></i>
                        @endif
                        @if($activity->log_type == 'create') 
                            Created
                        @elseif($activity->log_type == 'update') 
                            Updated a
                        @elseif($activity->log_type == 'commented')
                            Commented on 
                        @elseif($activity->log_type == 'delete')
                            Deleted
                        @endif
                        {{ $activity->log_params['subject_type'] }} 
                        @if($activity->log_params['subject_type'] == 'comment') 
                            @if($activity->log_type == 'delete')
                                from 
                            @else
                                on
                            @endif
                            page <a href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('wikis.pages.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                        @else 
                            <a href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('wikis.pages.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                        @endif
                        @if($activity->log_params['subject_type'] == 'page' || $activity->log_params['subject_type'] == 'comment') 
                            at wiki 
                            <a href="{{ route('wikis.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ]) }}" title="{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}">{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}</a>
                        @endif                    
                    </div>
                    <div class="clearfix"></div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="row text-center" style="margin-top: 15px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            {{ $activities->links() }}
        </div>
    </div>
@else
    <h3 class="nothing-found">Nothing found...</h3>
@endif