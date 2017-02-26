<?php

namespace App\Models;

use Auth;
use Baum\Node;
use Carbon\Carbon;
use App\Models\Wiki;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Node
{
    use Sluggable, RecordsActivity, SoftDeletes;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $wiki;

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

    public function comments()
    {
        return $this->hasMany(Comment::class, 'subject_id', 'id')->where('comments.subject_type', Page::class)->with('user');
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
        $query = $this;
        $query = $query->where('wiki_page.wiki_id', '=', $wikiId);
        $query = $query->with(['wiki'])->get();
        if(!$query) {
            return false;
        }
        return $query;
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
            'name' => $data['page_name'],
            'description' => $data['page_description'],
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

    public function changePageParent($nodeId, $parentId)
    {
        $node   = $this->find($nodeId);
        if ($parentId == '#') {
            $node->makeRoot();
        } else {
            $parent = $this->find($parentId);
            $node->makeChildOf($parent);
        }
        return true;   
    }
}
