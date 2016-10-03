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

    public function getWikis()
    {
        return $this->with(['organization', 'pages', 'user'])->paginate(10);
    }

    public function getWiki($id)
    {
        if($this->find($id)) {
            return $this->where('id', '=', $id)->with(['organization', 'pages', 'user'])->get();
        }

        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function saveWiki($data)
    {
        $this->create([
            'name' => $data['wiki_name'],
            'user_id' => Auth::user()->id,
            'organization_id' => 2
        ]);

        return response()->json([
            'message' => 'Wiki succesfully created.'
        ], Response::HTTP_CREATED);
    }

    public function deleteWiki($id)
    {
        $this->where('id', '=', $id)->delete();

        return response()->json([
            'message' => 'Wiki succesfully deleted.'
        ], Response::HTTP_NO_CONTENT);
    }

    public function updateWiki($id, $data)
    {
        $wiki = $this->find($id);
        $wiki->name = $data['wiki_name'];
        $wiki->save();

        return response()->json([
            'message' => 'Wiki succesfully updated.'
        ], Response::HTTP_OK);
    }
}
