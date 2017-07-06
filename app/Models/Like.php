<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Like
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Like extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_type', 'subject_id', 'user_id', 'created_at', 'updated_at',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the like.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get all the wikis that are liked by a user.
     *
     * @param $userId integer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUserLikeWikis($userId)
    {
        return $this
            ->join('wiki', function ($join) {
                $join->on('likes.subject_id', '=', 'wiki.id')
                     ->whereNull('wiki.deleted_at');
            })
            ->where('likes.user_id', $userId)
            ->where('likes.subject_type', Wiki::class)
            ->with(['subject'])
            ->get();
    }
}
