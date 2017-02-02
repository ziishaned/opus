<?php

namespace App\Models;

use Auth;
use Emojione;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable, RecordsActivity;

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
        'category_name' => 'required',
    ];

    protected $table = 'category';

    protected $fillable = [
        'name',
        'slug',
    	'outline',
    	'user_id',
    	'organization_id',
    	'created_at',
    	'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'category_id', 'id');
    }

    public function createCategory($data, $organizationId)
    {
    	$this->create([
    		'name' 			  => $data['category_name'],
            'outline'         => $data['description'],
	    	'user_id' 		  => Auth::user()->id,
	    	'organization_id' => $organizationId,
    	]);
    	return true;
    }

    public function getCategories($organizationId)
    {
        return $this->where('organization_id', '=', $organizationId)->paginate(15);
    }

    public function deleteCategory($categoryId)
    {
        $this->find($categoryId)->delete();
        return true;
    }

    public function updateCategory($data, $categoryId, $organizationId)
    {
        $this->find($categoryId)->update([
                                    'name' => $data['category_name'],
                                    'outline' => $data['description'],
                                ]);
        return true;
    }

    public function getOrganizationCategories($id)
    {
        return $this->where('organization_id', '=', $id)->get();
    }

    public function getCategory($categorySlug, $organizationId)
    {
        return $this->where('slug', '=', $categorySlug)
                    ->where('organization_id', '=', $organizationId)
                    ->with(['wikis'])
                    ->first();   
    }
}
