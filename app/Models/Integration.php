<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Integration
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Integration extends Model
{
    use Sluggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'integration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'url', 'team_id', 'user_id', 'created_at', 'updated_at',
    ];

    const INTEGRATION_RULES = [
        'title' => 'required',
        'url'   => 'required|url',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * Get the team that owns the integration.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * Get the user that owns the integration.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the integration actions that owns by a team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function integrationActions()
    {
        return $this->belongsToMany(IntegrationAction::class, 'team_integration_actions', 'integration_id', 'integration_action_id');
    }

    /**
     * Create a new integration
     *
     * @param $data   array
     * @param $teamId integer
     * @return static
     */
    public function storeIntegration($data, $teamId)
    {
        return $this->create([
            'title'   => $data['title'],
            'url'     => $data['url'],
            'team_id' => $teamId,
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * Get all the integration actions of a team.
     *
     * @param $teamId integer
     * @return mixed
     */
    public function getTeamIntegration($teamId)
    {
        return $this->where('team_id', $teamId)->with(['integrationActions'])->get();
    }

    /**
     * Update integration.
     *
     * @param $id
     * @param $data
     * @return mixed
     *
     */
    public function updateIntegration($id, $data)
    {
        return $this->find($id)->update([
            'title' => $data['title'],
            'url'   => $data['url'],
        ]);
    }

    public function deleteIntegration($id)
    {
        return $this->find($id)->delete();
    }
}
