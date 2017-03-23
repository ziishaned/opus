<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchWiki extends Model
{
    protected $table = 'watch_wiki';

    protected $fillable = [
        'wiki_id',
        'user_id',
        'updated_at',
        'created_at',
    ];
	
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function wiki()
	{
		return $this->belongsTo(Wiki::class, 'wiki_id', 'id');
	}
}