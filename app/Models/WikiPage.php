<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

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
     * @param  integer $id
     * @return mixed
     */
    public function getPages($id)
    {
        $query = $this;
        $query = $query->where('wiki_page.wiki_id', '=', $id);
        $query = $query->where('wiki_page.parent_id', '=', null);
        $query = $query->with('pages')->get();
        if(!$query) {
            return false;
        }
        return $query;
    }

    public function filterWikiPages($wikiId, $text)
    {
        $query = $this->where('wiki_id', '=', $wikiId)->where('name', 'like', '%' . $text . '%')->get();
        return $query;
    }

    public function saveWikiPage($wikiId, $data)
    {
        $page = $this->create([
            'name'         =>  $data['page_name'],
            'description'  =>  !empty($data['page_description']) ? $data['page_description'] : null,
            'parent_id'    =>  !empty($data['page_parent']) ? $data['page_parent'] : null,
            'user_id'      =>  Auth::user()->id,
            'wiki_id'      =>  $wikiId,
        ]);

        ActivityLogHelper::createWikiPage($page);
        return $page->id;
    }

    public function getPage($id)
    {
        $page = $this->where('id', '=', $id)->where('user_id', '=', Auth::user()->id)->with('comments')->first();
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
        ]);

        return true;
    }

    public function deletePage($id)
    {
        $query = $this->where('id', '=', $id)->delete();

        if(!$query) {
            return false;
        }
        return true;
    }

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
