<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReadList
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class ReadList extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'read_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_type', 'subject_id', 'user_id', 'updated_at', 'created_at',
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the read list item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Delete a subject(Wiki, Page) from read list.
     *
     * @param $subjectId
     * @param $subjectType
     * @return bool
     */
    public function deleteSubject($subjectId, $subjectType)
    {
        return $this->where('user_id', Auth::user()->id)->where('subject_id', $subjectId)->where('subject_type', $subjectType)->delete();
    }

    /**
     * Create a new subject(Wiki, Page).
     *
     * @param $subjectId
     * @param $subjectType
     * @return static
     */
    public function createSubject($subjectId, $subjectType)
    {
        return ReadList::create([
            'subject_id'   => $subjectId,
            'subject_type' => $subjectType,
            'user_id'      => Auth::user()->id,
        ]);
    }

    /**
     * Get the read list of a user.
     *
     * @param int $userId
     * @return mixed
     */
    public function getUserReadList($userId)
    {
        return $this->where('user_id', $userId)->with(['subject'])->latest()->paginate(30);
    }
}
