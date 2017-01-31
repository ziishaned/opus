<div class="affix-top" data-spy="affix" data-offset-top="10" style="width: 360px;">
	<div class="row v-center mb25">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<div class="pull-left v-center">
				<img src="{!! new LetterAvatar($wiki->name, 'circle', 44) !!}" alt="">
				<h3 class="headin-no-margin ml10 wiki-name"><a href="{{ route('wikis.show', [$organization->slug, $wiki->category->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h3>
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
			<div>
				<div class="dropdown">
					<a href="#" class="dropdown-toggle wiki-setting-btn" data-toggle="dropdown"><i class="fa fa-ellipsis-v fa-lg fa-fw"></i></a>
	                <ul class="dropdown-menu dropdown-menu-right marginless">
	                    <li>
	        				<a href="{{ route('wikis.overview', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}"><i class="fa fa-info fa-fw"></i> Overview</a>
	        			</li>
	        			<li>
	        				<a href="#"><i class="fa fa-calendar-o fa-fw"></i> Activity</a>
	        			</li>
	        			<li>
	        				<a href="#"><i class="fa fa-key fa-fw"></i> Permissions</a>
	        			</li>
	        			<li>
		                    <a href="{{ route('pages.reorder', [$organization->slug, $wiki->category->slug, $wiki->slug]) }}"><i class="fa fa-reorder fa-fw"></i> Reorder pages</a>
		                </li>
		                <li class="divider"></li>
						<li>
							<a href="#"><i class="fa fa-trash-o fa-fw"></i> Delete</a>
						</li>
	                </ul>
				</div>	
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading"><i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Shortcuts can only be added by admins"></i> Page shortcuts</div>
		<div class="panel-body">
			<ul class="list-unstyled marginless">
				<li class="text-center">This wiki does not have any shortcuts yet.</li>
			</ul>
		</div>
	</div>
	<div>
		<div class="panel panel-default" id="wiki-list-con">
	        <div class="panel-heading">Page tree</div>
	    	<div class="panel-body" style="padding-left: 0px !important; padding-bottom: 10px; padding-right: 0px; min-height: 320px; overflow-y: auto;">
				@if(isset($page)) 
					<div id="current-page-slug" class="hide">{{ $page->slug }}</div>
					<div id="current-page-id" class="hide">{{ $page->id }}</div>
				@endif
				<div id="wiki-page-tree" style="margin-top: -7px;" data-wiki-slug="{{ $wiki->slug }}" data-organization-slug="{{ $organization->slug }}" data-category-slug="{{ $category->slug }}"></div>
	    	</div>
	    </div>
	</div>
</div>