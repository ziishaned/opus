<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
        'user_id',
        'updated_at',
        'created_at',
        'organization_id',
    ];

    /**
     * @const array
     */
    const WIKI_RULES = [
        'wiki_name' => 'required|max:35|min:3',
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

    /**
     * Retrieve a wiki from database.
     *
     * @param  integer $id
     * @return mixed
     */
    public function getWiki($id)
    {
        $query = $this->where('id', '=', $id);
        $query = $query->with(['organization', 'pages', 'user'])->first();
        if(!$query) {
            return false;
        }
        return $query;

    }

    /**
     * Create a wiki
     *
     * @param  array $data
     * @return bool
     */
    public function saveWiki($data)
    {
        $this->create([
            'name' => $data['wiki_name'],
            'user_id' => Auth::user()->id,
            'organization_id' => 2
        ]);

        return true;
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
        ]);

        return true;
    }
}
