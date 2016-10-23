<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use App\Helpers\ActivityLogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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

    const COMMENT_RULES = [
        'comment' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wiki()
    {
        return $this->belongsTo(Wiki::class, 'page_id', 'id');
    }

    public function wikiPage()
    {
        return $this->belongsTo(WikiPage::class, 'page_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function comments()
    {
        return $this->childs()->with('comments');
    }

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

    public function storeComment($pageId, $data)
    {
        ActivityLogHelper::createComment($pageId, $data['comment']);
        $this->create([
            'page_id'    => $pageId,
            'content'    => $data['comment'],
            'user_id'    => Auth::user()->id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        return true;        
    }
}
