<div class="side-menu hidden-sm hidden-xs">
    <div class="wiki-side-menu">
        <div class="side-menu-inner">
            <div class="wiki-intro">
                <div class="pull-left">
                    <h1 class="header" style="position: relative; top: 4px;"><a href="{{ route('wikis.show', [$team->slug, $space->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h1>
                </div>
                <div class="pull-right wiki-like-con">
                    <i class="fa fa-spinner fa-spin fa-lg fa-fw" id="spinner"></i>
                    <a href="#" id="like-wiki" data-wiki="{{ $wiki->slug }}"><i class="fa fa-star-o fa-fw" data-toggle="tooltip" data-placement="bottom" title="{{ $isUserLikeWiki ? 'Unlike' : 'Like' }}" style="margin-right: 3px; font-size: 16px;"></i></a> <span class="label" id="likes-counter" style="color: #9c9c9c; font-size: 12px; font-weight: 600; padding: 0px; margin-left: 2px;">{{ $wiki->likes->count() }}</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled side-menu-top">
                <li class="nav-header" style="margin-bottom: 5px;">Quick Links</li>
                <li class="item">
                    <a href="{{ route('pages.create', [ $team->slug, $space->slug, $wiki->slug]) }}">
                        <i class="fa fa-file-text-o fa-fw fa-lg icon"></i>
                        <span class="item-name">Create a Page</span>
                    </a>
                </li>
                <li class="item {{ (Route::currentRouteName() == 'wikis.settings' ? 'active' : '') }}">
                    <a href="{{ route('wikis.settings', [$team->slug, $space->slug, $wiki->slug, ]) }}">
                        <i class="fa fa-gear fa-fw fa-lg icon"></i> 
                        <span class="item-name">Wiki Settings</span>
                    </a>
                </li>
            </ul>
            {{-- <div class="side-menu-page-shortcuts-list" style="margin-bottom: 25px;">
                <ul class="list-unstyled">
                    <li class="nav-header">Shortcuts</li>
                    <li class="nothing-found" style="margin-top: 14px; font-size: 12px;"><i class="fa fa-exclamation-triangle fa-fw icon"></i> Nothing found</li>
                </ul>
            </div> --}}
            <div class="side-menu-page-tree-list" style="margin-bottom: 15px;">
                <div class="nav-header" style="margin-bottom: 10px;" title="You can move any page by dragging it to a new position in the tree.">Page tree</div>
                @if(isset($page))
                    <span class="hidden" id="page-open" data-page="{{ $page->slug }}"></span>
                @endif
                <div id="wiki-page-tree" data-wiki="{{ $wiki->slug }}" @if(isset($page)) data-page="{{ $page->id }}" @endif></div>
            </div>
        </div>
    </div>
</div>