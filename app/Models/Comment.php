<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\Comment\CreateCommentNotification;

/**
 * Class Comment
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Comment extends Model
{
    use RecordsActivity, SoftDeletes, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'subject_type', 'subject_id', 'user_id', 'updated_at', 'created_at',
    ];

    protected $dates = ['deleted_at'];

    const COMMENT_RULES = [
        'comment' => 'required|min:2',
    ];

    public function routeNotificationForSlack()
    {
        $integration = Team::getIntegration(Auth::user()->getTeam()->id);

        return $integration ? $integration->url : null;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($comment) {
            (new Comment)->notify(new CreateCommentNotification($comment));
        });
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wiki()
    {
        return $this->belongsTo(Wiki::class, 'subject_id', 'id')->withTrashed();
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'subject_id', 'id')->withTrashed();
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'subject_id', 'id')->where('likes.subject_type', Comment::class);
    }

    /**
     * Create a new comment against a provided subject (wiki, page).
     *
     * @param $subjectId   integer
     * @param $subjectType string
     * @param $data        array
     * @return static
     */
    public function storeComment($subjectId, $subjectType, $data)
    {
        return $this->create([
            'subject_id'   => $subjectId,
            'subject_type' => $subjectType,
            'content'      => $data['comment'],
            'user_id'      => Auth::user()->id,
            'updated_at'   => Carbon::now(),
            'created_at'   => Carbon::now(),
        ]);
    }

    /**
     * Delete a comment
     *
     * @param $id integer
     * @return mixed
     */
    public function deleteComment($id)
    {
        return $this->find($id)->where('user_id', Auth::user()->id)->delete();
    }

    /**
     * Update a comment
     *
     * @param $data array
     * @return mixed
     */
    public function updateComment($data)
    {
        return $this->find($data['commentId'])->update([
            'content' => $data['comment'],
        ]);
    }
}
