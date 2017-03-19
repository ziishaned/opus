<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    public function createTags($tags, $subjectType, $subjectId)
    {
        foreach ($tags as $inputTag) {
            
            $tag = $this->create([
                'name' => $inputTag,
            ]);

            DB::table('page_tags')->insert([
                'tag_id'       => $tag->id,
                'subject_type' => $subjectType,
                'subject_id'   => $subjectId,
                'created_at'   => \Carbon\Carbon::now(),
                'updated_at'   => \Carbon\Carbon::now(),
            ]);
            
        }

        return true;
    }
}
