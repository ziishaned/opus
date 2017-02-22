<div class="side-menu hidden-sm hidden-xs">
    <div class="wiki-side-menu">
        <div class="side-menu-inner">
            <div class="wiki-intro">
                <h1 class="header v-center"><img src="{!! new Avatar($wiki->name, 'circle', 44) !!}" alt="" style="margin-right: 15px;"> <a href="{{ route('wikis.show', [$team->slug, $category->slug, $wiki->slug, ]) }}">{{ $wiki->name }}</a></h1>
            </div>
            <ul class="list-unstyled side-menu-top">
                <li class="nav-header" style="margin-bottom: 8px;">Quick Links</li>
                <li class="item {{ (Route::currentRouteName() == 'wikis.activity' ? 'active' : '') }}">
                    <a href="{{ route('wikis.activity', [$team->slug, $category->slug, $wiki->slug]) }}">
                        <img src="/img/icons/basic_clockwise.svg" width="24" height="24" class="icon">
                        <span class="item-name">Activity</span>
                    </a>
                </li>
                <li class="item">
                    <a href="wikis-list.html">
                        <img src="/img/icons/basic_sheet_multiple .svg" width="24" height="24" class="icon">
                        <span class="item-name">All Pages</span>
                    </a>
                </li>
                <li class="item">
                    <a href="wikis-list.html">
                        <img src="/img/icons/basic_elaboration_document_plus.svg" width="24" height="24" class="icon">
                        <span class="item-name">Create a Page</span>
                    </a>
                </li>
            </ul>
            <div class="side-menu-page-shortcuts-list">
                <ul class="list-unstyled">
                    <li class="nav-header">Shortcuts</li>
                    <li class="text-center text-muted" style="margin-top: 5px;">Nothing found...</li>
                </ul>
            </div>
            <div class="side-menu-page-tree-list">
                <ul class="list-unstyled">
                    <li class="nav-header">Page tree</li>
                </ul>
            </div>
        </div>
        <div class="wiki-setting-bottom">
            <div class="dropup">
                <button class="btn dropdown-toggle wiki-setting-button" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/img/icons/basic_gear.svg" width="20" height="20" style="position: relative; top: -2px; margin-right: 3px;"> Wiki Settings
                    <i class="fa fa-caret-down fa-fw"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <li><a href="#"><i class="fa fa-info-circle fa-fw"></i> Overview</a></li>
                    <li><a href="#"><i class="fa fa-lock fa-fw"></i> Permissions</a></li>
                    <li><a href="#"><i class="fa fa-exclamation-triangle fa-fw"></i> Notifications</a></li>
                    <li><a href="#"><i class="fa fa-slack fa-fw"></i> Integrations</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="fa fa-list-ol fa-fw"></i> Reorder pages</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>