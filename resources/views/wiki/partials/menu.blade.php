<div class="side-menu hidden-sm hidden-xs">
    <div class="wiki-side-menu">
        <div class="side-menu-inner">
            <div class="wiki-intro">
                <div class="pull-left">
                    <h1 class="header v-center"><img src="{!! new Avatar($wiki->name, 'square', 32) !!}" alt="" style="margin-right: 12px; border-radius: 3px;"> <a href="{{ route('wikis.show', [$team->slug, $category->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h1>
                </div>
                <div class="pull-right wiki-like-con" style="position: relative; top: 4px;">
                    <i class="fa fa-spinner fa-spin fa-lg fa-fw" id="spinner"></i>
                    <a href="#" id="like-wiki" data-wiki="{{ $wiki->slug }}"><img src="/img/icons/basic_heart.svg" data-toggle="tooltip" data-placement="bottom" title="{{ $isUserLikeWiki ? 'Unlike' : 'Like' }}" width="20" height="20" style="margin-right: 3px;"></a> <span class="label label-default" id="likes-counter">{{ $wiki->likes->count() }}</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled side-menu-top">
                <li class="nav-header" style="margin-bottom: 5px;">Quick Links</li>
                <li class="item {{ (Route::currentRouteName() == 'wikis.activity' ? 'active' : '') }}">
                    <a href="{{ route('wikis.activity', [$team->slug, $category->slug, $wiki->slug]) }}">
                        <img src="/img/icons/basic_clockwise.svg" width="24" height="24" class="icon">
                        <span class="item-name">Activity</span>
                    </a>
                </li>
                <li class="item">
                    <a href="{{ route('pages.create', [ $team->slug, $category->slug, $wiki->slug]) }}">
                        <img src="/img/icons/basic_elaboration_document_plus.svg" width="24" height="24" class="icon">
                        <span class="item-name">Create a Page</span>
                    </a>
                </li>
            </ul>
            <div class="side-menu-page-shortcuts-list">
                <ul class="list-unstyled">
                    <li class="nav-header">Shortcuts</li>
                    <li class="text-center text-muted" style="margin-top: 5px; font-size: 13px;">Nothing found...</li>
                </ul>
            </div>
            <div class="side-menu-page-tree-list" style="margin-bottom: 15px;">
                <div class="nav-header" style="margin-bottom: 10px;" title="You can move any page by dragging it to a new position in the tree.">Page tree</div>
                @if(isset($page))
                    <span class="hidden" id="page-open" data-page="{{ $page->slug }}"></span>
                @endif
                <div id="wiki-page-tree" data-wiki="{{ $wiki->slug }}" @if(isset($page)) data-page="{{ $page->id }}" @endif></div>
            </div>
        </div>
        <div class="wiki-setting-bottom">
            <a href="{{ route('wikis.overview', [$team->slug, $category->slug, $wiki->slug, ]) }}" class="btn wiki-setting-button btn-block">
                <img src="/img/icons/basic_gear.svg" width="20" height="20"> Wiki Settings
            </a>
        </div>
    </div>
</div>