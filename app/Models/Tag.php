<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use Sluggable;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

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

    public function updateTags($tags, $subjectType, $subjectId)
    {
        DB::table('page_tags')->where('subject_type', $subjectType)->where('subject_id', $subjectId)->delete();

        foreach ($tags as $inputTag) {
            if(gettype($inputTag) === 'string' && (int)$inputTag === 0) {
                $tag = $this->create([
                    'name' => $inputTag,
                ]);
            }

            DB::table('page_tags')->insert([
                'tag_id'       => isset($tag) ? $tag->id : $inputTag,
                'subject_type' => $subjectType,
                'subject_id'   => $subjectId,
                'created_at'   => \Carbon\Carbon::now(),
                'updated_at'   => \Carbon\Carbon::now(),
            ]);
            
        }

        return true;
    }
}
