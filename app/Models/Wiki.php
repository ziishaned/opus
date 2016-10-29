<?php

namespace App\Models;

use App\Helpers\ActivityLogHelper;
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
        'description',
        'outline',
        'wiki_type',
        'user_id',
        'organization_id',
        'updated_at',
        'created_at',
    ];

    /**
     * @const array
     */
    const WIKI_RULES = [
        'wiki_name' => 'required|max:35|min:3',
    ];

    /**
     * @const array
     */
    const WIKI_PAGE_RULES = [
        'page_name' => 'required|max:35|min:3',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
    public function getWikis($limit = null)
    {
        if(!is_null($limit)) {
            return $this->where('user_id', '=', Auth::user()->id)->with(['organization', 'pages', 'user'])->latest()->limit(5)->get();
        }
        return $this->where('user_id', '=', Auth::user()->id)->with(['organization', 'pages', 'user'])->get();
    }

    /**
     * Get a specific resource.
     *
     * @param  string $nameSlug
     * @return bool
     */
    public function getWiki($nameSlug)
    {
        $wiki = $this->where('slug', '=', $nameSlug)->where('user_id', '=', Auth::user()->id)->first();
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
    public function saveWiki($data)
    {
        $wiki = $this->create([
            'name'            =>  $data['wiki_name'],
            'outline'         =>  $data['outline'],
            'description'     =>  $data['page_description'],
            'user_id'         =>  Auth::user()->id,
            'organization_id' =>  !empty($data['organization_id']) ? $data['organization_id'] : null,
            'wiki_type'       =>  !empty($data['organization_id']) ? 'organization' : 'personal',
        ]);

        ActivityLogHelper::createWiki($wiki);
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
        $query = $this->where('slug', '=', $slug)->delete();

        if(!$query) {
            return false;
        }
        return true;
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
        $this->where('slug', '=', $slug)->update([
            'name' => $data['wiki_name'],
            'description' => $data['wiki_description'],
        ]);

        return true;
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
}
