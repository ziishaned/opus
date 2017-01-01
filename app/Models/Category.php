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
}
