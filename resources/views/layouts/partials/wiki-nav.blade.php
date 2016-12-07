<div class="row">
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		<h3 style="margin-bottom: 0;"><a href="#">{{ $wiki->name }}</a></h3>
		<p style="margin-bottom: 0;" class="text-muted">Created by {{ ViewHelper::getUsername($wiki->user_id) }} on {{ $wiki->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() }} at {{ $wiki->created_at->timezone(Session::get('user_timezone'))->format('h:i A') }} </p>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
		<ul class="list-inline list-unstyled" style="position: relative; top: 5px;">
			@if($wiki->wiki_watching) 
				<li>
					<button data-wiki-id="{{ $wiki->id }}" id="watch-wiki-btn" class="btn btn-default btn-sm pull-left" style="border-radius: 3px 0px 0px 3px;">
				        Unwatch
				    </button>
				    <div class="count-with-arrow pull-left">
						<span class="count wiki-watch-count" style="line-height: 9px;"> {{ ViewHelper::getWikiWatch($wiki->id) }} </span>
					</div>
					<div class="clearfix"></div>
				</li>
			@else
				<li>
					<button data-wiki-id="{{ $wiki->id }}" id="watch-wiki-btn" class="btn btn-default btn-sm pull-left" style="border-radius: 3px 0px 0px 3px;">
				        Watch
				    </button>
				    <div class="count-with-arrow pull-left">
						<span class="count wiki-watch-count" style="line-height: 9px;"> {{ ViewHelper::getWikiWatch($wiki->id) }} </span>
					</div>
					<div class="clearfix"></div>
				</li>
			@endif
		</ul>
	</div>
</div>