@if(count($activities) > 0)
    <ul class="activity-con" style="padding: 0; list-style: none; margin-bottom: 0px;">
        @foreach($activities as $activity)
            <li class="activity-item" style="border-bottom: 1px solid #efefef; padding: 8px 0; padding-bottom: 15px; padding-top: 15px;">
                <?php $profile_image = ViewHelper::getProfilePic($activity->user_id); ?> 
                @if(empty($profile_image))
                    <img src="/images/default.png" class="avatar hidden-xs hidden-sm" alt="Avatar" style="height: 64px; width: 64px; float: left; display: inline-block; border-radius: 3px; margin-right: 25px;">
                @else 
                    <img src="/images/profile-pics/{{ $profile_image }}" class="avatar hidden-xs hidden-sm" alt="Avatar" style="height: 64px; width: 64px; float: left; display: inline-block; border-radius: 3px; margin-right: 25px;">
                @endif

                <div class="message_wrapper pull-left">
                    <h3 style="font-weight: 600; margin: 0; margin-bottom: 5px;"><a href="#">{{ $activity->first_name .' '. $activity->last_name }}</a></h3>
                    <div class="message">
                        <div class="message-icon-con pull-left">
                            @if($activity->log_type == 'delete')
                                <i class="fa fa-trash-o fa-fw" style="color: #9E9E9E; margin-right: 6px;"></i>
                            @elseif($activity->log_type == 'commented')
                                <i class="fa fa-commenting-o fa-fw" style="color: #9E9E9E; margin-right: 6px;"></i>
                            @else
                                <i class="fa fa-file-text-o fa-fw" style="color: #9E9E9E; margin-right: 6px;"></i>
                            @endif
                        </div>
                        <div class="message-content pull-left">
                            <p>
                                @if($activity->log_params['subject_type'] == 'wiki')
                                    <a href="@if($activity->log_params['subject_type'] == 'wiki') {{ route('wikis.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['id']), ]) }} @else {{ route('pages.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ViewHelper::getPageSlug($activity->log_params['id'])]) }} @endif" title="{{ $activity->log_params['name'] }}">{{ $activity->log_params['name'] }}</a>
                                @endif
                                @if($activity->log_params['subject_type'] == 'page') 
                                    <a href="{{ route('wikis.show', [$organization->slug, ViewHelper::getWikiSlug($activity->log_params['wiki_id']), ]) }}" title="{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}">{{ ViewHelper::getWikiName($activity->log_params['wiki_id']) }}</a>
                                @endif
                            </p>     
                            <p style="color: #9E9E9E; font-size: 12px;">
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
                    </div>
                </div>
                <div class="clearfix"></div>
            </li>
        @endforeach
    </ul>
    <div class="row text-center activity-pagination-con hide" style="margin-top: 15px; margin-bottom: 10px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul class="pagination">
                <?php
                    $currentPage = $activities->currentPage(); 
                ?>
                @while($currentPage <= $activities->lastPage())
                    <li class="{{ ($currentPage == 2) ? 'next' : '' }}">
                        <a href="http://wiki.dev/organizations/facebook/activity?page={{ $currentPage }}">{{ $currentPage }}</a>
                    </li>
                    <?php
                        $currentPage++;
                    ?>
                @endwhile
            </ul>
        </div>
    </div>
@else
    <h3 class="nothing-found">Nothing found...</h3>
@endif