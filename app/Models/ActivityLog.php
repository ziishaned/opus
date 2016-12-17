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
        'orgainzation_id',
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

    /**
     * Return activities of a user.
     * @param  int      $userId
     * @return object         
     */
    public function getUserActivities($userId)
    {
        return $this
                    ->where('activity_log.user_id', '=', $userId)
                    ->join('users', 'activity_log.user_id', '=', 'users.id')
                    ->latest('activity_log.created_at')
                    ->select('activity_log.*', 'users.first_name', 'users.last_name', 'users.slug as user_slug')
                    ->paginate(10);
    }

    /**
     * This funtion will return user activities plus the activities of the users he is following.
     *  
     * @param  int      $userId
     * @return object
     */
    public function getUserAllActivities($userId)
    {
        return $this
                ->join('users', 'activity_log.user_id', '=', 'users.id')
                ->where('activity_log.user_id', '=', $userId)
                ->select('activity_log.*', 'users.first_name', 'users.last_name', 'users.slug as user_slug')
                ->latest('activity_log.created_at')
                ->paginate(10);
    }

    public function getOrganizationActivity($id) 
    {
        return $this
                ->join('users', 'activity_log.user_id', '=', 'users.id')
                ->where('activity_log.organization_id', '=', $id)
                ->select('activity_log.*', 'users.first_name', 'users.last_name', 'users.slug as user_slug')
                ->latest('activity_log.created_at')
                ->paginate(10);   
    }
}
