<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 *
 * @package App\Models
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Activity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id', 'subject_type', 'name', 'user_id', 'team_id', 'created_at', 'updated_at',
    ];

    public function subject()
    {
        return $this->morphTo()->withTrashed();
    }

    /**
     * Get the user that owns the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the team that owns the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
