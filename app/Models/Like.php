<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $table = 'likes';

    protected $fillable = [
        'subject_type',
        'subject_id',
        'user_id',
    	'created_at',
    	'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function getUserLikeWikis($id)
    {
        $likes = $this->where('user_id', $id)->where('subject_type', 'App\Models\Wiki')->with(['subject'])->limit(7)->latest()->get();

        return $likes;
    }
}
