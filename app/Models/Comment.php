<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use App\Models\WikiPage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Models
 */
class Comment extends Model
{

    use RecordsActivity, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'comment';

    /**
     * @var array
     */
    protected $fillable = [
        'page_id',
        'content',
        'user_id',
        'updated_at',
        'created_at',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @const array COMMENT_RULES
     */
    const COMMENT_RULES = [
        'comment' => 'required',
    ];
    
    /**
     * A user can post comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * A wiki can have comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wiki()
    {
        return $this->belongsTo(Wiki::class, 'page_id', 'id');
    }

    /**
     * Wiki pages can have comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wikiPage()
    {
        return $this->belongsTo(WikiPage::class, 'page_id', 'id');
    }

    /**
     * Create a new comment.
     *
     * @param string  $pageSlug
     * @param array  $data
     * @return bool
     */
    public function storeComment($pageId, $data)
    {
        $this->create([
            'page_id'    => $pageId,
            'content'    => $data['comment'],
            'user_id'    => Auth::user()->id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        return true;        
    }

    public function deleteComment($id) {
        $this->find($id)->delete();
        
        return true;
    }

    public function updateComment($id, $data) {
        $this->find($id)->update([
            'content' => $data['comment'],
        ]);

        return true;
    }
}
