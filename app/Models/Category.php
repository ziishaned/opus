<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const CATEGORY_RULES = [
        'category_name' => 'required',
    ];

    protected $table = 'category';

    protected $fillable = [
    	'name',
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

    public function wiki()
    {
        return $this->belongsTo(Wiki::class);
    }

    public function createCategory($data, $organizationId)
    {
    	$this->create([
    		'name' 			  => $data['category_name'],
	    	'user_id' 		  => Auth::user()->id,
	    	'organization_id' => $organizationId,
    	]);
    	return true;
    }

    public function getCategories($organizationId)
    {
        return $this->where('organization_id', '=', $organizationId)->paginate(15);
    }

    public function deleteCategory($categoryId, $organizationId)
    {
        $this->where('id', '=', $categoryId)->where('organization_id', '=', $organizationId)->delete();
        return true;
    }

    public function updateCategory($data, $categoryId, $organizationId)
    {
        $this->where('id', '=', $categoryId)
             ->where('organization_id', '=', $organizationId)
             ->update([
                    'name' => $data['category_name'],
             ]);
        return true;
    }

    public function getOrganizationCategories($id)
    {
        return $this->where('organization_id', '=', $id)->get();
    }
}
