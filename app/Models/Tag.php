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

    public function wikis()
    {
        return $this->belongsToMany(Wiki::class, 'page_tags', 'tag_id', 'subject_id')->where('subject_type', 'App\Models\Wiki');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_tags', 'tag_id', 'subject_id')->where('subject_type', 'App\Models\Page');
    }

    public function getTeamTagWikis($teamId, $tagId)
    {
        return $this->find($tagId)->wikis()->paginate(30);
    }

    public function getTeamTagPages($teamId, $tagId)
    {
        return $this->find($tagId)->pages()->paginate(30);
    }

    public function createTags($tags, $subjectType, $subjectId)
    {
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
