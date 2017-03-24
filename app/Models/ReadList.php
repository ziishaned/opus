<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadList extends Model
{
    protected $table = 'read_list';

    protected $fillable = [
        'subject_type',
        'subject_id',
        'user_id',
        'updated_at',
        'created_at',
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
