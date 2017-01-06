<?php

namespace App\Models;

use DB;
use Emojione;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Wiki
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Models
 */
class Wiki extends Model
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
    protected $table = 'wiki';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'outline',
        'description',
        'visibilty',
        'user_id',
        'organization_id',
        'updated_at',
        'created_at',
    ];

    /**
     * @const array
     */
    const WIKI_RULES = [
        'wiki_name'       => 'required|max:45|min:1',
        'wiki_visibility' => 'required',
    ];

    /**
     * @const array
     */
    const WIKI_PAGE_RULES = [
        'page_name' => 'required|max:35|min:3',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'category_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * A wiki can have many pages.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages() {
        return $this->hasMany(WikiPage::class, 'wiki_id', 'id');
    }

    /** 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization() {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    /**
     * Retrieve all wikis from database.
     *
     * @param null $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getOrganizationWikis($id)
    {
        return $this
                    ->where('user_id', '=', Auth::user()->id)
                    ->where('organization_id', '=', $id)
                    ->latest()
                    ->get();
    }

    /**
     * Get a specific resource.
     *
     * @param $wikiSlug
     * @param $organizationId
     *
     * @return bool
     * @internal param string $nameSlug
     */
    public function getWiki($wikiSlug, $organizationId)
    {
        $wiki = $this->where('slug', '=', $wikiSlug)->where('organization_id', '=', $organizationId)->with('user')->first();
        if(is_null($wiki)) {
            return false;
        }
        return $wiki;
    }

    /**
     * Create a wiki
     *
     * @param  array $data
     * @return bool
     */
    public function saveWiki($data, $organizationId)
    {
        Emojione::$imagePathPNG = '/images/png/';
        $wiki = $this->create([
            'name'            =>  $data['wiki_name'],
            'category_id'     =>  $data['category_id'],
            'outline'         =>  Emojione::toImage($data['outline']),
            'description'     =>  Emojione::toImage($data['wiki_description']),
            'user_id'         =>  Auth::user()->id,
            'visibilty'       =>  $data['wiki_visibility'],
            'organization_id' =>  $organizationId,
        ]);

        return $wiki;
    }

    /**
     * Delete wiki
     *
     * @param  string $slug
     * @return bool
     */
    public function deleteWiki($slug)
    {
        $wiki = $this->where('slug', '=', $slug)->first();
        $query = $this->where('slug', '=', $slug)->delete();

        if(!$query) {
            return false;
        }
        return $wiki;
    }

    /**
     * Update wiki
     *
     * @param  string $slug
     * @param  array  $data
     * @return bool
     */
    public function updateWiki($slug, $data)
    {
        $wiki              =  $this->where('slug', '=', $slug)->first();
        $wiki->name        =  $data['wiki_name'];
        $wiki->outline     =  $data['outline'];
        $wiki->description =  $data['wiki_description'];
        $wiki->save();
        
        return $wiki;
    }

    /**
     * Filter wikis.
     *
     * @param string $text
     * @return \App\Models\Wiki
     */
    public function filterWikis($text)
    {
        $query = $this;
        $query = $query->where('user_id', '=', Auth::user()->id);
        $query = $query->where('name', 'like', '%' . $text . '%')->get();   

        return $query;
    }

    public function star($id)
    {
        $wikiStarred = DB::table('user_star')
                           ->where('entity_id', '=', $id)
                           ->where('user_id', '=', Auth::user()->id)
                           ->where('entity_type', '=', 'wiki')
                           ->first();

        if(is_null($wikiStarred)) {
            DB::table('user_star')->insert([
                'entity_id'     => $id,
                'entity_type'   => 'wiki',
                'user_id'       => Auth::user()->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
            return true;
        }

        DB::table('user_star')
            ->where('entity_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->where('entity_type', '=', 'wiki')
            ->delete();
        return false;
    }

    public function watch($id)
    {
        $wikiWacthed = DB::table('user_watch')
                           ->where('entity_id', '=', $id)
                           ->where('user_id', '=', Auth::user()->id)
                           ->where('entity_type', '=', 'wiki')
                           ->first();

        if(is_null($wikiWacthed)) {
            DB::table('user_watch')->insert([
                'entity_id'     => $id,
                'entity_type'   => 'wiki',
                'user_id'       => Auth::user()->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
            return true;
        }
        DB::table('user_watch')
            ->where('entity_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->where('entity_type', '=', 'wiki')
            ->delete();
        return false;
    }
}
