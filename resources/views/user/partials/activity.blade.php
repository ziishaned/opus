@if($activities->count() > 0)
    <div class="events-list">
        @foreach($activities as $activity)
            <div class="media event">
                <a class="pull-left event-user-image" href="#">
                    <img class="media-object" style="border-radius: 3px;" src="/img/no-image.png" width="42" height="42" alt="Image">
                </a>
                <div class="media-body">
                    <div class="event-top">
                        <div class="pull-left event-icon">
                            @if($activity->name == 'created_category')
                                <img src="/img/icons/ecommerce_sales.svg" width="22" height="22" alt="Image">
                            @endif

                            @if($activity->name == 'deleted_category')
                                <img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">
                            @endif

                            @if($activity->name == 'updated_category')
                                <img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">                                              
                            @endif

                            @if($activity->name == 'created_wiki')
                                <img src="/img/icons/basic_book.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'deleted_wiki')
                                <img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'updated_wiki')
                                <img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'created_page')
                                <img src="/img/icons/basic_webpage_txt.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'deleted_page')
                                <img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'updated_page')
                                <img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">                                              
                            @endif

                            @if($activity->name == 'created_comment')
                                <img src="/img/icons/basic_message.svg" width="22" height="22" alt="Image">
                            @endif

                            @if($activity->name == 'deleted_comment')
                                <img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'updated_comment')
                                <img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">                                                
                            @endif
                        </div>
                        <div class="pull-left">
                            @if($activity->name == 'created_category')
                                You created category <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a>.
                            @endif
                            
                            @if($activity->name == 'deleted_category')
                                You deleted category <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'updated_category')
                                You updated category <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'created_wiki')
                                You created wiki <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'deleted_wiki')
                                You deleted wiki <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'updated_wiki')
                                You updated wiki <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'created_page')
                                You created page <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'deleted_page')
                                You deleted page <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'updated_page')
                                You updated page <a href="" style="color: #337ab7;">{{ $activity->subject['name'] }}</a> at wiki <a href="" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                            @endif

                            @if($activity->name == 'created_comment')
                                @if($activity->subject->subject_type === 'App\Models\Wiki')
                                    You commented on wiki <a href="" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                                @else
                                    You commented on page <a href="" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.
                                @endif
                            @endif

                            @if($activity->name == 'deleted_comment')
                                @if($activity->subject->subject_type === 'App\Models\Wiki')
                                    You deleted comment from wiki <a href="" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a> at wiki .
                                @else
                                    You deleted comment from page <a href="" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.
                                @endif
                            @endif

                            @if($activity->name == 'updated_comment')
                                @if($activity->subject->subject_type === 'App\Models\Wiki')
                                    You updated comment on wiki <a href="" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.
                                @else
                                    You updated comment on page <a href="" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.
                                @endif
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @if($activity->name == 'created_comment' || $activity->name == 'deleted_comment' || $activity->name == 'updated_comment')
                        <p style="border: 1px solid #ddd; padding: 6px 11px; border-radius: 3px; margin-bottom: 5px; background-color: #fbfbfb; margin-top: 10px;">{!! (new Emoji)->render($activity->subject->content) !!}</p>
                    @endif
                    <p class="text-muted"><span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $activity->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</span></p>
                </div>
            </div>
        @endforeach
    </div>
@else 
    <h1 class="nothing-found">No activity found</h1>
@endif