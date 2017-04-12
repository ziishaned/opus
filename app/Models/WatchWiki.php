<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WatchWiki
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class WatchWiki extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'watch_wiki';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wiki_id', 'user_id', 'updated_at', 'created_at',
    ];

    /**
     * Get the user that is watching a wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the wiki that is watched by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wiki()
    {
        return $this->belongsTo(Wiki::class, 'wiki_id', 'id');
    }

    /**
     * Get all the user that are watching a wiki.
     *
     * @param $wikiId integer
     * @return mixed
     */
    public function getWikiWatchers($wikiId)
    {
        return $this->where('wiki_id', $wikiId)->get();
    }

    public function unwatchWiki($wikiId)
    {
        return $this->where('user_id', Auth::user()->id)->where('wiki_id', $wikiId)->delete();
    }

    public function watchWiki($wikiId)
    {
        return $this->create([
            'wiki_id' => $wikiId,
            'user_id' => Auth::user()->id,
        ]);
    }
}
