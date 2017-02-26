<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use RecordsActivity, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'comments';

    protected $fillable = [
        'content',
        'subject_type',
        'subject_id',
        'user_id',
        'updated_at',
        'created_at',
    ];

    protected $dates = ['deleted_at'];

    const COMMENT_RULES = [
        'comment' => 'required|min:2',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function wiki()
    {
        return $this->belongsTo(Wiki::class, 'subject_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'subject_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'subject_id', 'id')->where('likes.subject_type', Comment::class);
    }

    public function storeWikiComment($wikiId, $data)
    {
        $this->create([
            'subject_id' => $wikiId,
            'subject_type' => Wiki::class,
            'content'    => $data['comment'],
            'user_id'    => Auth::user()->id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        return true;        
    }

    public function storePageComment($pageId, $data)
    {
        $this->create([
            'subject_id' => $pageId,
            'subject_type' => Page::class,
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
