<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    const CATEGORY_RULES = [
        'name' => 'required|unique:category,name|max:25',
    ];

    protected $table = 'category';

    protected $fillable = [
        'name',
        'slug',
    	'outline',
    	'user_id',
    	'team_id',
    	'created_at',
    	'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'category_id', 'id');
    }

    public function createCategory($data, $teamId)
    {
    	$this->create([
    		'name' 		=> $data['name'],
            'outline'   => $data['description'],
	    	'user_id' 	=> Auth::user()->id,
	    	'team_id'   => $teamId,
    	]);
    	return true;
    }

    public function getTeamCategories($teamId)
    {
        return $this->where('team_id', '=', $teamId)->get();
    }

    public function deleteCategory($categoryId)
    {
        $this->find($categoryId)->delete();
        return true;
    }

    public function updateCategory($data, $categoryId, $teamId)
    {
        $this->find($categoryId)->update([
                                    'name' => $data['category_name'],
                                    'outline' => $data['description'],
                                ]);
        return true;
    }

    public function getCategory($categorySlug, $teamId)
    {
        return $this->where('slug', '=', $categorySlug)
                    ->where('team_id', '=', $teamId)
                    ->with(['wikis'])
                    ->first();   
    }
}
