<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wiki;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected $like;

    protected $wiki;
    
    protected $request;

    public function __construct(Request $request, Like $like, Wiki $wiki)
    {
        $this->request = $request;
        $this->like    = $like;
        $this->wiki    = $wiki;
    }

    public function storeLike()
    {
        if($this->request->get('subjectType') === 'wiki') {
            $wiki = $this->wiki->where('slug', $this->request->get('subject'))->first();
            
            $like = $this->handleLike('App\Models\Wiki', $wiki->id);
            
            if($like) {
                return response()->json([
                    'like' => true
                ], 200); 
            }

            return response()->json([
                'like' => false
            ], 200); 
        }
    }

    public function handleLike($subject, $subjectId)
    {
        $existing_like = $this
                            ->like
                            ->withTrashed()
                            ->where('subject_id', $subjectId)
                            ->where('subject_type', $subject)
                            ->where('user_id', Auth::user()->id)
                            ->first();

        if (is_null($existing_like)) {
            Like::create([
                'subject_id'   => $subjectId,
                'subject_type' => $subject,
                'user_id'      => Auth::user()->id
            ]);
            return true;
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
                return false;
            } else {
                $existing_like->restore();
                return true;
            }
        }

    }
}
