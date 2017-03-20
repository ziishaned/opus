[1mdiff --git a/app/Http/Controllers/WikiController.php b/app/Http/Controllers/WikiController.php[m
[1mindex 8b279af..6822b87 100644[m
[1m--- a/app/Http/Controllers/WikiController.php[m
[1m+++ b/app/Http/Controllers/WikiController.php[m
[36m@@ -136,7 +136,8 @@[m [mclass WikiController extends Controller[m
     public function getWikiActivity(Team $team, Space $space, Wiki $wiki)[m
     {[m
         $isUserLikeWiki = $this->isUserLikeWiki($wiki);[m
[31m-        $activities     = $this->wiki->getActivty($wiki->id)->activity;[m
[32m+[m[41m        [m
[32m+[m[32m        $activities     = $this->wiki->getActivty($wiki->id);[m
 [m
         return view('wiki.activity', compact('team', 'space', 'wiki', 'activities', 'isUserLikeWiki'));[m
     }[m
[1mdiff --git a/app/Models/Page.php b/app/Models/Page.php[m
[1mindex 4cf14e1..7b42a0e 100644[m
[1m--- a/app/Models/Page.php[m
[1m+++ b/app/Models/Page.php[m
[36m@@ -103,6 +103,11 @@[m [mclass Page extends Node[m
         return $this->belongsTo(User::class, 'user_id', 'id');[m
     }[m
 [m
[32m+[m[32m    public function getPages($wikiId)[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->where('wiki_id', '=', $wikiId)->with(['wiki'])->get();[m
[32m+[m[32m    }[m
[32m+[m
     public function getRootPages($wiki)[m
     {[m
         $roots = $this->whereNull('parent_id')->where('wiki_id', '=', $wiki->id)->with(['wiki', 'childPages'])->get();[m
[1mdiff --git a/app/Models/Wiki.php b/app/Models/Wiki.php[m
[1mindex a2824c3..bdb2e6b 100644[m
[1m--- a/app/Models/Wiki.php[m
[1m+++ b/app/Models/Wiki.php[m
[36m@@ -79,9 +79,12 @@[m [mclass Wiki extends Model[m
 [m
     public function activity()[m
     {[m
[31m-        return $this->hasMany(Activity::class, 'subject_id', 'id')->where('activities.subject_type', Wiki::class)->with(['user', 'subject' => function($query) {[m
[31m-            $query->withTrashed();[m
[31m-        }])->latest();[m
[32m+[m[32m        return $this->hasMany(Activity::class, 'subject_id', 'id')[m
[32m+[m[32m                    ->orWhere('subject_type', 'App\Models\Comment')[m
[32m+[m[32m                    ->orWhere('subject_type', 'App\Models\Page')[m
[32m+[m[32m                    ->with(['user', 'subject' => function($query) {[m
[32m+[m[32m                        $query->withTrashed();[m
[32m+[m[32m                    }])->latest();[m
     }[m
 [m
     public function likes()[m
[36m@@ -100,7 +103,7 @@[m [mclass Wiki extends Model[m
     }[m
 [m
     public function pages() {[m
[31m-        return $this->hasMany(WikiPage::class, 'wiki_id', 'id');[m
[32m+[m[32m        return $this->hasMany(Page::class, 'wiki_id', 'id');[m
     }[m
 [m
     public function team() {[m
[36m@@ -165,8 +168,6 @@[m [mclass Wiki extends Model[m
 [m
     public function getActivty($id)[m
     {[m
[31m-        $team = $this->where('id', $id)->with(['activity'])->first();[m
[31m-[m
[31m-        return $team;[m
[32m+[m[32m        return $this->find($id)->activity()->paginate(30);[m
     }[m
 }[m
[1mdiff --git a/opus.todo b/opus.todo[m
[1mindex e69de29..024be97 100644[m
[1m--- a/opus.todo[m
[1m+++ b/opus.todo[m
[36m@@ -0,0 +1 @@[m
[32m+[m[32mtags empty exception[m
\ No newline at end of file[m
[1mdiff --git a/resources/views/wiki/partials/activity.blade.php b/resources/views/wiki/partials/activity.blade.php[m
[1mindex 07aa62b..227f139 100644[m
[1m--- a/resources/views/wiki/partials/activity.blade.php[m
[1m+++ b/resources/views/wiki/partials/activity.blade.php[m
[36m@@ -2,104 +2,138 @@[m
     <div class="events-list">[m
         @foreach($activities as $activity)[m
             <div class="media event">[m
[31m-                <a class="pull-left event-user-image" href="#">[m
[31m-                    <img class="media-object img-circle" src="/img/no-image.png" width="50" height="50" alt="Image">[m
[32m+[m[32m                <a class="pull-left event-user-image" href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}">[m
[32m+[m[32m                    @if(!empty($activity->user->profile_image))[m
[32m+[m[32m                        <img class="media-object" style="border-radius: 3px;" src="/img/avatars/{{ $activity->user->profile_image }}" width="44" height="44" alt="Image">[m
[32m+[m[32m                    @else[m
[32m+[m[32m                        <img class="media-object" style="border-radius: 3px;" src="/img/no-image.png" width="44" height="44" alt="Image">[m
[32m+[m[32m                    @endif[m
                 </a>[m
                 <div class="media-body">[m
                     <div class="event-top">[m
                         <div class="pull-left event-icon">[m
                             @if($activity->name == 'created_space')[m
[31m-                                <img src="/img/icons/ecommerce_sales.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-tag fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
                             @if($activity->name == 'deleted_space')[m
[31m-                                <img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-trash-o fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
                             @if($activity->name == 'updated_space')[m
[31m-                                <img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-save fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
                             @if($activity->name == 'created_wiki')[m
[31m-                                <img src="/img/icons/basic_book.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-book fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
                             @if($activity->name == 'deleted_wiki')[m
[31m-                                <img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-trash-o fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
                             @if($activity->name == 'updated_wiki')[m
[31m-                                <img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-save fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
[31m-                            @if($activity->name == 'created_wikipage')[m
[31m-                                <img src="/img/icons/basic_webpage_txt.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                            @if($activity->name == 'created_page')[m
[32m+[m[32m                                <i class="fa fa-file-text-o fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
[31m-                            @if($activity->name == 'deleted_wikipage')[m
[31m-                                <img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                            @if($activity->name == 'deleted_page')[m
[32m+[m[32m                                <i class="fa fa-trash-o fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
[31m-                            @if($activity->name == 'updated_wikipage')[m
[31m-                                <img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                            @if($activity->name == 'updated_page')[m
[32m+[m[32m                                <i class="fa fa-save fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
                             @if($activity->name == 'created_comment')[m
[31m-                                <img src="/img/icons/basic_message.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-comment-o fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
                             @if($activity->name == 'deleted_comment')[m
[31m-                                <img src="/img/icons/basic_trashcan.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-trash-o fa-fw fa-lg icon"></i>[m
                             @endif[m
 [m
                             @if($activity->name == 'updated_comment')[m
[31m-                                <img src="/img/icons/basic_floppydisk.svg" width="22" height="22" alt="Image">[m
[32m+[m[32m                                <i class="fa fa-save fa-fw fa-lg icon"></i>[m
                             @endif[m
                         </div>[m
[31m-                        <div class="pull-left">[m
[32m+[m[32m                        <div class="pull-left" style="position: relative; top: 2px;">[m
[32m+[m[32m                            @if($activity->name == 'created_space')[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created space <a href="{{ route('spaces.wikis', [$team->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.[m
[32m+[m[32m                            @endif[m
[32m+[m[41m                            [m
[32m+[m[32m                            @if($activity->name == 'deleted_space')[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted space <a href="{{ route('spaces.wikis', [$team->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.[m
[32m+[m[32m                            @endif[m
[32m+[m
[32m+[m[32m                            @if($activity->name == 'updated_space')[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated space <a href="{{ route('spaces.wikis', [$team->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.[m
[32m+[m[32m                            @endif[m
[32m+[m
                             @if($activity->name == 'created_wiki')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created a wiki <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->space->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.[m
                             @endif[m
 [m
                             @if($activity->name == 'deleted_wiki')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted a wiki <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->space->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.[m
                             @endif[m
 [m
                             @if($activity->name == 'updated_wiki')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated a wiki <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->space->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a>.[m
                             @endif[m
 [m
[31m-                            @if($activity->name == 'created_wikipage')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created a page <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                            @if($activity->name == 'created_page')[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> created page <a href="{{ route('pages.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.[m
                             @endif[m
 [m
[31m-                            @if($activity->name == 'deleted_wikipage')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted a page <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                            @if($activity->name == 'deleted_page')[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted page <a href="{{ route('pages.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject->name }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.[m
                             @endif[m
 [m
[31m-                            @if($activity->name == 'updated_wikipage')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated a page <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                            @if($activity->name == 'updated_page')[m
[32m+[m[32m                                <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated page <a href="{{ route('pages.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug, $activity->subject->slug]) }}" style="color: #337ab7;">{{ $activity->subject['name'] }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.[m
                             @endif[m
 [m
                             @if($activity->name == 'created_comment')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> commented on a page <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                                @if($activity->subject->subject_type === 'App\Models\Wiki')[m
[32m+[m[32m                                    <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> commented on wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.[m
[32m+[m[32m                                @else[m
[32m+[m[32m                                    <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> commented on page <a href="{{ route('pages.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug, $activity->subject->page->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.[m
[32m+[m[32m                                @endif[m
                             @endif[m
 [m
                             @if($activity->name == 'deleted_comment')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted comment from a page <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                                @if($activity->subject->subject_type === 'App\Models\Wiki')[m
[32m+[m[32m                                    <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted comment from wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.[m
[32m+[m[32m                                @else[m
[32m+[m[32m                                    <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> deleted comment from page <a href="{{ route('pages.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug, $activity->subject->page->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.[m
[32m+[m[32m                                @endif[m
                             @endif[m
 [m
                             @if($activity->name == 'updated_comment')[m
[31m-                                <a href="#">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated comment on page <a href="">{{ $activity->subject['name'] }}</a>.[m
[32m+[m[32m                                @if($activity->subject->subject_type === 'App\Models\Wiki')[m
[32m+[m[32m                                    <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated comment on wiki <a href="{{ route('wikis.show', [$team->slug, $activity->subject->wiki->space->slug, $activity->subject->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->wiki->name }}</a>.[m
[32m+[m[32m                                @else[m
[32m+[m[32m                                    <a href="{{ route('users.show', [$team->slug, $activity->user->slug]) }}" style="color: #337ab7;">{{ $activity->user->first_name .' '. $activity->user->last_name }}</a> updated comment on page <a href="{{ route('wikis.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->name }}</a> at wiki <a href="{{ route('pages.show', [$team->slug, $activity->subject->page->wiki->space->slug, $activity->subject->page->wiki->slug, $activity->subject->page->slug]) }}" style="color: #337ab7;">{{ $activity->subject->page->wiki->name }}</a>.[m
[32m+[m[32m                                @endif[m
                             @endif[m
                         </div>[m
                         <div class="clearfix"></div>[m
                     </div>[m
[31m-                    <p class="text-muted"><span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $activity->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</span></p>[m
[32m+[m[32m                    @if($activity->name == 'created_comment' || $activity->name == 'deleted_comment' || $activity->name == 'updated_comment')[m
[32m+[m[32m                        <p style="padding: 2px 11px; margin-bottom: 5px; margin-top: 10px; border-left: 2px solid #eee;">{!! (new Emoji)->render($activity->subject->content) !!}</p>[m
[32m+[m[32m                    @endif[m
[32m+[m[32m                    <p class="text-muted" style="font-size: 13px; color: #b7b7b7;"><span data-toggle="tooltip" data-placement="bottom" title="{{ $activity->created_at->timezone(Session::get('user_timezone'))->toFormattedDateString() . ' at ' . $activity->created_at->timezone(Session::get('user_timezone'))->format('h:i A')}}">{{ $activity->created_at->timezone(Session::get('user_timezone'))->diffForHumans() }}</span></p>[m
                 </div>[m
             </div>[m
         @endforeach[m
[32m+[m[32m        <div class="text-center">[m
[32m+[m[32m            {{ $activities->links() }}[m
[32m+[m[32m        </div>[m
     </div>[m
[31m-@else[m
[32m+[m[32m@else[m[41m [m
     <h1 class="nothing-found side"><i class="fa fa-exclamation-triangle fa-fw icon"></i> Nothing found</h1>[m
 @endif[m
\ No newline at end of file[m
[1mdiff --git a/resources/views/wiki/partials/menu.blade.php b/resources/views/wiki/partials/menu.blade.php[m
[1mindex 1f4d8f7..f31e3d4 100644[m
[1m--- a/resources/views/wiki/partials/menu.blade.php[m
[1m+++ b/resources/views/wiki/partials/menu.blade.php[m
[36m@@ -13,12 +13,6 @@[m
             </div>[m
             <ul class="list-unstyled side-menu-top">[m
                 <li class="nav-header" style="margin-bottom: 5px;">Quick Links</li>[m
[31m-                <li class="item {{ (Route::currentRouteName() == 'wikis.activity' ? 'active' : '') }}">[m
[31m-                    <a href="{{ route('wikis.activity', [$team->slug, $space->slug, $wiki->slug]) }}">[m
[31m-                        <i class="fa fa-history fa-fw fa-lg icon"></i>[m
[31m-                        <span class="item-name">Activity</span>[m
[31m-                    </a>[m
[31m-                </li>[m
                 <li class="item">[m
                     <a href="{{ route('pages.create', [ $team->slug, $space->slug, $wiki->slug]) }}">[m
                         <i class="fa fa-file-text-o fa-fw fa-lg icon"></i>[m
