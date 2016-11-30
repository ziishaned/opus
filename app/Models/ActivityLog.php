<?php

namespace App\Models;

use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    /**
     * @var string
     */
    protected $table = 'activity_log';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'log_type',
        'log_params',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'log_params' => 'array',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function createActivity($subjectType, $logType, $logContent)
    {
    	array_add($logContent, 'subject_type', $subjectType);
    	$this->create([
    		'user_id' 	 =>  Auth::user()->id,
    		'log_type' 	 =>	 $logType,
    		'log_params' =>  json_decode($logContent),
    	]);
    	return true;	
    }

    public function getUserActivities($userId)
    {
        // $activity->created_at->timezone('Asia/Karachi')->diffForHumans()
        // dd(\Carbon\Carbon::now());
        return $this->join('user_followers', function ($join){
                        $join->on('activity_log.user_id', '=', 'user_followers.follow_id');
                    })
                    ->where('activity_log.user_id', $userId)
                    ->orwhereRaw('IFNULL(user_followers.user_id, 0) = ' . $userId . '')
                    ->latest('activity_log.created_at')
                    ->paginate(10);
    }
}
