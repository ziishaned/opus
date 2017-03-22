<?php

namespace App\Models;

use Auth;
use Baum\Node;
use Carbon\Carbon;
use App\Models\Wiki;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\Page\CreatePageNotification;
use App\Notifications\Page\DeletePageNotification;
use App\Notifications\Page\UpdatePageNotification;

class Page extends Node
{
    use Sluggable, RecordsActivity, SoftDeletes, Notifiable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table = 'page';

    protected $orderColumn = 'position';

    protected $fillable = [
        'name',
        'outline',
        'description',
        'position',
        'parent_id',
        'user_id',
        'wiki_id',
        'created_at',
        'updated_at',
        'lft',
        'rgt',
        'depth',
    ];

    const PAGE_RULES = [
        'name' => 'required|max:35',
    ];

    protected $dates = ['deleted_at'];

    public function routeNotificationForSlack()
    {
        $integration = Team::find(Auth::user()->team->first()->id)->with(['integration'])->first()->integration;

        return $integration ? $integration->url : null;
    }

    public static function boot()
    {
        parent::boot();

        $pageObject = new Page();

        static::created(function($page) use ($pageObject) {
            $pageObject->notify(new CreatePageNotification($page));
        });

        static::updated(function($page) use ($pageObject) {
            $pageObject->notify(new UpdatePageNotification($page));
        });

        static::deleting(function($page) use ($pageObject) {
            $pageObject->notify(new DeletePageNotification($page));
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'subject_id', 'id')->where('comments.subject_type', Page::class)->with('user');
    }    

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'page_tags', 'subject_id', 'tag_id')->where('page_tags.subject_type', 'App\Models\Page');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'subject_id', 'id')->where('likes.subject_type', Page::class);
    }

    public function childPages()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id')->with('childPages');
    }

    public function wiki() {
        return $this->belongsTo(Wiki::class, 'wiki_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getPages($wikiId)
    {
        return $this->where('wiki_id', '=', $wikiId)->with(['wiki'])->get();
    }

    public function getRootPages($wiki)
    {
        $roots = $this->whereNull('parent_id')->where('wiki_id', '=', $wiki->id)->with(['wiki', 'childPages'])->get();

        return $roots;
    }

    public function getPageChilds($page) 
    {
        $page = $this->where('slug', $page)->first();

        $childs = $this->where('parent_id', $page->id)->with(['wiki', 'childPages'])->get();

        return $childs;
    }

    public function getTreeTo($page)
    {
        $nodes = $this->find($page->id)->getAncestorsAndSelf()->toHierarchy();   
        return $nodes;
    }

    public function saveWikiPage($wiki, $data)
    {
        $page = $this->create([
            'name'         =>  $data['name'],
            'outline'      =>  !empty($data['outline']) ? $data['outline'] : null,
            'description'  =>  !empty($data['description']) ? $data['description'] : null,
            'parent_id'    =>  !empty($data['page_parent']) ? $data['page_parent'] : null,
            'position'     =>  $data['position'],
            'user_id'      =>  Auth::user()->id,
            'wiki_id'      =>  $wiki->id,
        ]);

        return $page;
    }

    public function getPage($slug)
    {
        $page = $this->where('slug', '=', $slug)->where('user_id', '=', Auth::user()->id)->with(['comments', 'wiki'])->first();
        if(is_null($page)) {
            return false;
        }
        return $page;
    }

    public function updatePage($id, $data)
    {
        $this->find($id)->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'outline' => $data['outline'],
            'parent_id'    =>  !empty($data['page_parent']) ? $data['page_parent'] : null,
        ]);
    
        return true;
    }

    public function deletePage($id)
    {
        $this->find($id)->delete();

        return true;
    }
}
