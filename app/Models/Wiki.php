<?php

namespace App\Models;

use App\Notifications\Wiki\DeleteWikiNotification;
use App\Notifications\Wiki\UpdateWikiNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\Wiki\CreateWikiNotification;

class Wiki extends Model
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

    protected $table = 'wiki';

    protected $fillable = [
        'name',
        'slug',
        'space_id',
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
        'space' => 'required',
    ];

    public function routeNotificationForSlack()
    {
        $integration = Team::find(Auth::user()->team->first()->id)->with(['integration'])->first()->integration;

        return $integration ? $integration->url : null;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($wiki) {
            (new Wiki)->notify(new CreateWikiNotification($wiki));
        });

        static::updated(function($wiki) {
            (new Wiki)->notify(new UpdateWikiNotification($wiki));
        });

        static::deleting(function($wiki) {
            (new Wiki)->notify(new DeleteWikiNotification($wiki));
        });
    }

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
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
            $wikis = $this->where('team_id', $teamId)->with(['space', 'likes'])->latest()->take(5)->get();

            return $wikis;
        }
        
        $wikis = $this->where('team_id', $teamId)->latest()->paginate(10);

        return $wikis;
    }

    public function getWiki($wikiSlug, $teamId)
    {
        $wiki = $this->where('slug', '=', $wikiSlug)->where('team_id', '=', $teamId)->with(['user', 'space'])->first();
        if($wiki === null) {
            return false;
        }
        return $wiki;
    }

    public function saveWiki($data, $teamId)
    {
        $wiki = $this->create([
            'name'            =>  $data['name'],
            'space_id'     =>  $data['space'],
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
