@if(count($activities) > 0)
    <ul class="list-unstyled mb0 list-bordered">
        @foreach($activities as $activity)
            <li>
                <div class="media">
                    <a class="pull-left" href="#">
                        @if(empty($activity->user->profile_image))
                            <img src="/images/default.png" class="media-object img-rounded" width="64" height="64">
                        @else
                            <img src="/images/profile-pics/{{ $activity->user->profile_image }}"
                                 class="media-object img-rounded" width="64" height="64">
                        @endif
                    </a>
                    <div class="media-body">
                        <p class="mb5">
                            @if($activity->name == 'created_category')
                                <i class="fa fa-bookmark-o fa-fw media-icon"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created a category <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                            @if($activity->name == 'deleted_category')
                                <i class="fa fa-trash-o fa-fw media-icon"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted a category <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                            @if($activity->name == 'updated_category')
                                <i class="fa fa-refresh fa-fw media-icon no-stroke"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated a category <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'created_wiki')
                                <span class="glyphicon glyphicon-book media-icon no-stroke"></span> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created a wiki <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                            @if($activity->name == 'deleted_wiki')
                                <i class="fa fa-trash-o fa-fw media-icon"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted a wiki <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                            @if($activity->name == 'updated_wiki')
                                <i class="fa fa-refresh fa-fw media-icon no-stroke"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated a wiki <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'created_wikipage')
                                <i class="fa fa-file-text-o fa-fw media-icon"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                            @if($activity->name == 'deleted_wikipage')
                                <i class="fa fa-trash-o fa-fw media-icon"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                            @if($activity->name == 'updated_wikipage')
                                <i class="fa fa-refresh fa-fw media-icon no-stroke"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'created_comment')
                                <span class="glyphicon glyphicon-comment media-icon no-stroke"></span> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> commented on a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                            @if($activity->name == 'deleted_comment')
                                <i class="fa fa-trash-o fa-fw media-icon"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted comment from a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                            @if($activity->name == 'updated_comment')
                                <i class="fa fa-refresh fa-fw media-icon no-stroke"></i> <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated comment on page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
                        </p>
                        <p class="text-muted activity-time mb0"><span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $activity->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</span></p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <h3 class="nothing-found">Nothing found...</h3>
@endif