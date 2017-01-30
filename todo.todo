@if(count($activities) > 0)
    <ul class="list-unstyled mb0 list-bordered">
        @foreach($activities as $activity)
            <li>
               <div class="media">
                   <a class="pull-left" href="#">
                       @if(empty($activity->user->profile_image))
                            <img src="/images/default.png" class="hidden-xs hidden-sm media-object" width="64" height="64">
                        @else 
                            <img src="/images/profile-pics/{{ $activity->user->profile_image }}" class="hidden-xs hidden-sm media-object" width="64" height="64">
                        @endif
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="#">{{ $activity->first_name .' '. $activity->last_name }}</a></h4>
                        <div class="pull-left">
                            @if($activity->log_type == 'delete')
                                <i class="fa fa-trash-o fa-fw media-icon"></i>
                            @elseif($activity->log_type == 'commented')
                                <i class="fa fa-commenting-o fa-fw media-icon media-icon"></i>
                            @else
                                <i class="fa fa-file-text-o fa-fw media-icon"></i>
                            @endif
                        </div>
                        <div class="pull-left">              
                           <p class="mb5 activity-content">
                                @if($activity->log_params['subject_type'] == 'wiki')
                                    {{-- <a href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('pages.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a> --}}
                                @endif
                                @if($activity->log_params['subject_type'] == 'page') 
                                    {{-- <a href="{{ route('wikis.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ]) }}" title="{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}">{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}</a> --}}
                                @endif
                            </p>
                            <p class="text-muted activity-time mb0">
                                @if($activity->log_type == 'create') 
                                    Created
                                @elseif($activity->log_type == 'update') 
                                    Updated
                                @elseif($activity->log_type == 'commented')
                                    Commented 
                                @elseif($activity->log_type == 'delete')
                                    Deleted
                                @endif
                                <span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $activity->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</span>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                   </div>
               </div> 
            </li>
        @endforeach
    </ul>
@else
    <h3 class="nothing-found">Nothing found...</h3>
@endif