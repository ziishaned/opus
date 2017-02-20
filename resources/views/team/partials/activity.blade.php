@if($activities->count() > 0)
	@foreach($activities as $activity)
		<div class="events-list">
			<div class="media event">
				<a class="pull-left event-user-image" href="#">
					<img class="media-object img-circle" src="/img/no-image.png" width="50" height="50" alt="Image">
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
								<img src="/img/icons/basic_notebook.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'deleted_wiki')
								<img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'updated_wiki')
								<img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'created_wikipage')
								<img src="/img/icons/basic_webpage_txt.svg" width="22" height="22" alt="Image">                                                
                            @endif

                            @if($activity->name == 'deleted_wikipage')
								<img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">				                                
                            @endif

                            @if($activity->name == 'updated_wikipage')
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
								<a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created a category <a href="">{{ $activity->subject['name'] }}</a>.
							@endif
							
                            @if($activity->name == 'deleted_category')
								<a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted a category <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'updated_category')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated a category <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'created_wiki')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created a wiki <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'deleted_wiki')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted a wiki <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'updated_wiki')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated a wiki <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'created_wikipage')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'deleted_wikipage')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'updated_wikipage')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'created_comment')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> commented on a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'deleted_comment')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted comment from a page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif

                            @if($activity->name == 'updated_comment')
                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated comment on page <a href="">{{ $activity->subject['name'] }}</a>.
                            @endif
						</div>
						<div class="clearfix"></div>
					</div>
					<p class="text-muted"><span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $activity->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</span></p>
				</div>
			</div>
		</div>
	@endforeach
@else 
	<h1 class="nothing-found"><img src="/img/icons/basic_info.svg" width="44"> No activity found</h1>
@endif