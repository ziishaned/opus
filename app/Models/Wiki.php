<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wiki extends Model
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

    protected $table = 'wiki';

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'outline',
        'description',
        'user_id',
        'team_id',
        'updated_at',
        'created_at',
    ];

    protected $dates = ['deleted_at'];

    const WIKI_RULES = [
        'name'     => 'required|max:45|min:3',
        'category' => 'required',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'subject_id', 'id')->where('activities.subject_type', Wiki::class)->with(['user', 'subject' => function($query) {
            $query->withTrashed();
        }])->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'subject_id', 'id')->where('likes.subject_type', Wiki::class);
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function pages() {
        return $this->hasMany(WikiPage::class, 'wiki_id', 'id');
    }

    public function team() {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'subject_id', 'id')->where('comments.subject_type', Wiki::class)->with(['user', 'likes']);
    }

    public function getTeamWikis($teamId, $total = null)
    {
        if($total !==  null) {
            $wikis = $this->where('team_id', $teamId)->with(['category', 'likes'])->latest()->take(5)->get();

            return $wikis;
        }
        
        $wikis = $this->where('team_id', $teamId)->latest()->paginate(10);

        return $wikis;
    }

    public function getWiki($wikiSlug, $teamId)
    {
        $wiki = $this->where('slug', '=', $wikiSlug)->where('team_id', '=', $teamId)->with(['user', 'category'])->first();
        if($wiki === null) {
            return false;
        }
        return $wiki;
    }

    public function saveWiki($data, $teamId)
    {
        $wiki = $this->create([
            'name'            =>  $data['name'],
            'category_id'     =>  $data['category'],
            'outline'         =>  $data['outline'],
            'description'     =>  $data['description'],
            'user_id'         =>  Auth::user()->id,
            'team_id'         =>  $teamId,
        ]);

        return $wiki;
    }

    public function deleteWiki($id)
    {
        $this->find($id)->delete();
        return true;
    }

    public function updateWiki($id, $data)
    {
        $this->find($id)->update([
            'description' =>  $data['description'],
        ]);

        return true;
    }

    public function getActivty($id)
    {
        $team = $this->where('id', $id)->with(['activity'])->first();

        return $team;
    }
}
