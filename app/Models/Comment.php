<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use App\Models\WikiPage;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Models
 */
class Comment extends Model
{
    /**
     * @var string
     */
    protected $table = 'comment';

    /**
     * @var \App\Models\WikiPage $wikiPage
     */
    protected $wikiPage;

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

    /**
     * @const array COMMENT_RULES
     */
    const COMMENT_RULES = [
        'comment' => 'required',
    ];

    /**
     * Comment constructor.
     *
     * @param \App\Models\WikiPage $wikiPage
     */
    public function __constructor(WikiPage $wikiPage)
    {
        $this->wikiPage = $wikiPage;
    }

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
     * Like a comment.
     *
     * @param integer  $id
     * @return bool
     */
    public function starComment($id)
    {
        $commentStarred = DB::table('user_star')->where('entity_id', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
        if(is_null($commentStarred)) {
            ActivityLogHelper::likeComment($id);
            DB::table('user_star')->insert([
                'entity_id'     => $id,
                'entity_type'   => 'comment',
                'user_id'       => Auth::user()->id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
            return true;
        }
        DB::table('user_star')->where('entity_id', '=', $id)->where('user_id', '=', Auth::user()->id)->delete();
        return false;
    }

    /**
     * Create a new comment.
     *
     * @param string  $pageSlug
     * @param array  $data
     * @return bool
     */
    public function storeComment($pageSlug, $data)
    {
        $page = $this->wikiPage->getPage($pageSlug);
        ActivityLogHelper::createComment($page, $data['comment']);
        $this->create([
            'page_id'    => $page->id,
            'content'    => $data['comment'],
            'user_id'    => Auth::user()->id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        return true;        
    }
}
