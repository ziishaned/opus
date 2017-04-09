<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\Space\CreateSpaceNotification;
use App\Notifications\Space\DeleteSpaceNotification;
use App\Notifications\Space\UpdateSpaceNotification;

/**
 * Class Space
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Space extends Model
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

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    const SPACE_RULES = [
        'name' => 'required|unique:space,name|max:25',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'space';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'outline', 'user_id', 'team_id', 'created_at', 'updated_at',
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

        static::created(function ($space) {
            $space->notify(new CreateSpaceNotification($space));
        });

        static::updated(function ($space) {
            $space->notify(new UpdateSpaceNotification($space));
        });

        static::deleting(function ($space) {
            $space->notify(new DeleteSpaceNotification($space));
        });
    }

    /**
     * Get the user that owns the space.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the team that owns the space.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * Get the wikis that owns the space.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wikis()
    {
        return $this->hasMany(Wiki::class, 'space_id', 'id');
    }

    /**
     * Create a new space.
     *
     * @param $data   array
     * @param $teamId integer
     * @return \App\Models\Space
     */
    public function createSpace($data, $teamId)
    {
        return $this->create([
            'name'    => $data['name'],
            'outline' => $data['description'],
            'user_id' => Auth::user()->id,
            'team_id' => $teamId,
        ]);
    }

    /**
     * Get all the spaces of a team.
     *
     * @param $teamId integer
     * @return mixed
     */
    public function getTeamSpaces($teamId)
    {
        return $this->where('team_id', $teamId)->with(['team'])->orderBy('name', 'asc')->get();
    }

    /**
     * Delete a space.
     *
     * @param $spaceId integer
     * @return bool
     */
    public function deleteSpace($spaceId)
    {
        return $this->find($spaceId)->delete();
    }

    /**
     * Update a space.
     *
     * @param $data    array
     * @param $spaceId integer
     * @param $teamId  integer
     * @return mixed
     */
    public function updateSpace($data, $spaceId, $teamId)
    {
        return $this->find($spaceId)->update([
            'name'    => $data['space_name'],
            'outline' => $data['description'],
        ]);
    }

    /**
     * Get a specific space.
     *
     * @param $spaceSlug string
     * @param $teamId    integer
     * @return mixed
     */
    public function getSpace($spaceSlug, $teamId)
    {
        return $this->where('slug', $spaceSlug)->where('team_id', $teamId)->with(['wikis'])->first();
    }
}
