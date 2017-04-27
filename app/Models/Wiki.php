<?php

namespace App\Models;

use Notifynder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\Wiki\CreateWikiNotification;
use App\Notifications\Wiki\DeleteWikiNotification;
use App\Notifications\Wiki\UpdateWikiNotification;

/**
 * Class Wiki
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Wiki extends Model
{
    use Sluggable, RecordsActivity, SoftDeletes, Notifiable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wiki';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'space_id', 'outline', 'description', 'user_id', 'team_id', 'updated_at', 'created_at',
    ];

    protected $dates = ['deleted_at'];

    const WIKI_RULES = [
        'name'  => 'required|max:45|min:3',
        'space' => 'required',
    ];

    public function routeNotificationForSlack()
    {
        $integration = Team::getIntegration(Auth::user()->getTeam()->id);

        return $integration ? $integration->url : null;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($wiki) {
            $wiki->notify(new CreateWikiNotification($wiki));
        });

        static::updated(function ($wiki) {
            $wiki->notify(new UpdateWikiNotification($wiki));

            $watchingList = (new WatchWiki)->getWikiWatchers($wiki->id);

            if (!empty($watchingList)) {
                foreach ($watchingList as $watch) {
                    $url = route('wikis.show', [Auth::user()->getTeam()->slug, $watch->wiki->space->slug, $watch->wiki->slug]);
                    Notifynder::category('wiki.updated')
                        ->from(Auth::user()->id)
                        ->to($watch->user_id)
                        ->url($url)
                        ->extra(['wiki_name' => $watch->wiki->name, 'username' => Auth::user()->name])
                        ->send();
                }
            }
        });

        static::deleting(function ($wiki) {
            $wiki->notify(new DeleteWikiNotification($wiki));

            $watchingList = (new WatchWiki)->getWikiWatchers($wiki->id);

            if (!empty($watchingList)) {
                foreach ($watchingList as $watch) {
                    $url = route('wikis.show', [Auth::user()->getTeam()->slug, $watch->wiki->space->slug, $watch->wiki->slug]);
                    Notifynder::category('wiki.deleted')
                        ->from(Auth::user()->id)
                        ->to($watch->user_id)
                        ->url($url)
                        ->extra(['wiki_name' => $watch->wiki->name, 'username' => Auth::user()->name])
                        ->send();
                }
            }
        });
    }

    /**
     * Get the space that owns the wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }

    /**
     * Get the user that owns the wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the likes that owns the wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'subject_id', 'id')->where('likes.subject_type', Wiki::class);
    }

    /**
     * Get the tags that owns the wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'page_tags', 'subject_id', 'tag_id')->where('page_tags.subject_type', Wiki::class);
    }

    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get the pages that owns the wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'wiki_id', 'id');
    }

    /**
     * Get the team that owns the wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * Get the comments that owns the wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'subject_id', 'id')->where('comments.subject_type', Wiki::class)->with(['user', 'likes']);
    }

    /**
     * Get the wikis of a team.
     *
     * @param int      $teamId
     * @param null|int $total
     * @return mixed
     */
    public function getTeamWikis($teamId, $total = null)
    {
        if ($total !== null) {
            return $this->where('team_id', $teamId)->with(['space', 'likes'])->latest()->take(5)->get();
        }

        return $this->where('team_id', $teamId)->latest()->paginate(10);
    }

    /**
     * Get a wiki.
     *
     * @param string $wikiSlug
     * @return bool
     */
    public function getWiki($wikiSlug)
    {
        $wiki = $this->where('slug', '=', $wikiSlug)->with(['user', 'space'])->first();

        if ($wiki === null) {
            return false;
        }

        return $wiki;
    }

    /**
     * Create a new wiki.
     *
     * @param array $data
     * @param int   $teamId
     * @return static
     */
    public function saveWiki($data, $teamId)
    {
        return $this->create([
            'name'        => $data['name'],
            'space_id'    => $data['space'],
            'outline'     => $data['outline'],
            'description' => $data['description'],
            'user_id'     => Auth::user()->id,
            'team_id'     => $teamId,
        ]);
    }

    /**
     * Delete a wiki.
     *
     * @param int $id
     * @return mixed
     */
    public function deleteWiki($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Update a wiki.
     *
     * @param int   $id
     * @param array $data
     * @return mixed
     */
    public function updateWiki($id, $data)
    {
        return $this->find($id)->update([
            'description' => $data['description'],
        ]);
    }

    /**
     * Get all the wikis of a space.
     *
     * @param $spaceId
     * @param $teamId
     * @return mixed
     */
    public function getSpaceWikis($spaceId, $teamId)
    {
        return $this->where('team_id', $teamId)->where('space_id', $spaceId)->latest()->paginate(30);
    }
}
