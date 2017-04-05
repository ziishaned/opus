<?php

namespace App\Models;

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
}
