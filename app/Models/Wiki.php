<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Wiki extends Model
{
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWikis()
    {
        return $this->with(['organization', 'pages', 'user'])->paginate(10);
    }

    public function getWiki($id)
    {
        $wiki = $this->where('id', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
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
            'description'     =>  $data['page_description'],
            'user_id'         =>  Auth::user()->id,
            'organization_id' =>  !empty($data['organization_id']) ? $data['organization_id'] : null,
            'wiki_type'       =>  !empty($data['organization_id']) ? 'organization' : 'personal',
        ]);

        return $wiki;
    }

    /**
     * Delete wiki
     *
     * @param  integer $id
     * @return bool
     */
    public function deleteWiki($id)
    {
        $query = $this->where('id', '=', $id)->delete();

        if(!$query) {
            return false;
        }
        return true;
    }

    /**
     * Update wiki
     *
     * @param  integer  $id
     * @param  array    $data
     * @return bool
     */
    public function updateWiki($id, $data)
    {
        $this->find($id)->update([
            'name' => $data['wiki_name'],
            'description' => $data['wiki_description'],
        ]);

        return true;
    }

    public function filterWikis($text)
    {
        $query = $this;
        $query = $query->where('user_id', '=', Auth::user()->id);
        $query = $query->where('name', 'like', '%' . $text . '%')->get();   

        return $query;
    }
}
