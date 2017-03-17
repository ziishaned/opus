<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\Category\CreateCategoryNotification;
use App\Notifications\Category\DeleteCategoryNotification;
use App\Notifications\Category\UpdateCategoryNotification;

class Category extends Model
{
    use Sluggable, RecordsActivity, SoftDeletes, Notifiable;

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

    public function routeNotificationForSlack()
    {
	$integration = Team::find(Auth::user()->team->first()->id)->with(['integration'])->first()->integration;

        return $integration ? $integration->url : null;
    }

    public static function boot()
    {
        parent::boot();

        $category = new Category();

        static::created(function($category) use ($category) {
            $category->notify(new CreateCategoryNotification($category));
        });

        static::updated(function($category) use ($category) {
            $category->notify(new UpdateCategoryNotification($category));
        });

        static::deleting(function($category) use ($category) {
            $category->notify(new DeleteCategoryNotification($category));
        });
    }

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
        return $this->where('team_id', $teamId)->get();
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
