<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use App\Models\Wiki;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class WikiPage
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Models
 */
class WikiPage extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @var \App\Models\Wiki
     */
    protected $wiki;

    /**
     * @var string
     */
    protected $table = 'wiki_page';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'user_id',
        'wiki_id',
        'created_at',
        'updated_at',
    ];

    /**
     * WikiPage constructor.
     *
     * @param \App\Models\Wiki $wiki
     */
    public function __construct(Wiki $wiki)
    {
        $this->wiki = $wiki;
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'page_id', 'id')->with('user');
    }    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wiki() {
        return $this->belongsTo(Wiki::class, 'wiki_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(WikiPage::class, 'parent_id', 'id');
    }

    /**
     * @return mixed
     */
    public function pages()
    {
        return $this->childs()->with('pages');
    }

    /**
     * Retrieve a wiki from database.
     *
     * @param  string $slug
     * @return mixed
     */
    public function getPages($slug)
    {
        $query = $this;
        $query = $query->where('wiki_page.slug', '=', $slug);
        $query = $query->where('wiki_page.parent_id', '=', null);
        $query = $query->with(['pages', 'wiki'])->get();
        if(!$query) {
            return false;
        }
        return $query;
    }

    /**
     * Filter wiki pges where wiki pages with a specific id.
     *
     * @param  int    $wikiId
     * @param  string $text
     * @return mixed
     */
    public function filterWikiPages($wikiId, $text)
    {
        $query = $this->where('wiki_id', '=', $wikiId)->where('name', 'like', '%' . $text . '%')->get();
        return $query;
    }

    /**
     * Create a new resource.
     *
     * @param  string $wikiSlug
     * @param  array  $data
     * @return static
     */
    public function saveWikiPage($wikiSlug, $data)
    {
        $wiki = $this->wiki->getWiki($wikiSlug);
        $page = $this->create([
            'name'         =>  $data['page_name'],
            'description'  =>  !empty($data['page_description']) ? $data['page_description'] : null,
            'parent_id'    =>  !empty($data['page_parent']) ? $data['page_parent'] : null,
            'user_id'      =>  Auth::user()->id,
            'wiki_id'      =>  $wiki->id,
        ]);

        ActivityLogHelper::createWikiPage($page);
        return $page;
    }

    /**
     * Get a specific resource.
     *
     * @param string $slug
     * @return bool
     */
    public function getPage($slug)
    {
        $page = $this->where('slug', '=', $slug)->where('user_id', '=', Auth::user()->id)->with(['comments', 'wiki'])->first();
        if(is_null($page)) {
            return false;
        }
        return $page;
    }

    /**
     * Update a specific resource.
     *
     * @param  int   $id
     * @param  array $data
     * @return bool
     */
    public function updatePage($id, $data)
    {
        $this->find($id)->update([
            'name' => $data['page_name'],
            'description' => $data['page_description'],
        ]);

        return true;
    }

    /**
     * Delete a specific resource.
     *
     * @param  int $id
     * @return bool
     */
    public function deletePage($id)
    {
        $query = $this->where('id', '=', $id)->delete();

        if(!$query) {
            return false;
        }
        return true;
    }

    /**
     * Star a specific resource.
     *
     * @param  int $id
     * @return bool
     */
    public function star($id)
    {
        $pageStarred = DB::table('user_star')->where('entity_id', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
        if(is_null($pageStarred)) {
            DB::table('user_star')->insert([
                'entity_id'     => $id,
                'entity_type'   => 'page',
                'user_id'       => Auth::user()->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
            return true;
        }
        DB::table('user_star')->where('entity_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();
        return false;
    }

    /**
     * Change the parent of a page.
     *
     * @param  array $data
     * @return bool
     */
    public function changeParent($data)
    {
        $page = $this->where('id', '=', $data['nodeId'])->first();
        
        if($page->parent_id == $data['parentId']) {
            $page->parent_id = null;
            $page->save();
            return true;
        }

        $page->parent_id = $data['parentId'];
        $page->save();
        return true;
    }
}
