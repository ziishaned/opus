<?php

namespace App\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Tag
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Tag extends Model
{
    use Sluggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'created_at', 'updated_at',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * Get the wikis that owns the tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wikis()
    {
        return $this->belongsToMany(Wiki::class, 'page_tags', 'tag_id', 'subject_id')->where('subject_type', Wiki::class);
    }

    /**
     * Get the pages that owns the tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_tags', 'tag_id', 'subject_id')->where('subject_type', Page::class);
    }

    /**
     * Get all the wikis of a tag.
     *
     * @param $teamId integer
     * @param $tagId  integer
     * @return mixed
     */
    public function getTeamTagWikis($teamId, $tagId)
    {
        return $this->find($tagId)->wikis()->paginate(30);
    }

    /**
     * Get all the pages of a tag.
     *
     * @param $teamId integer
     * @param $tagId  integer
     * @return mixed
     */
    public function getTeamTagPages($teamId, $tagId)
    {
        return $this->find($tagId)->pages()->paginate(30);
    }

    /**
     * Create tags against a subject(wiki, page).
     *
     * @param $tags        array
     * @param $subjectType string
     * @param $subjectId   integer
     * @return bool
     */
    public function createTags($tags, $subjectType, $subjectId)
    {
        foreach ($tags as $inputTag) {
            if (gettype($inputTag) === 'string' && (int)$inputTag === 0) {
                $tag = $this->create([
                    'name' => $inputTag,
                ]);
            }

            DB::table('page_tags')->insert([
                'tag_id'       => isset($tag) ? $tag->id : $inputTag,
                'subject_type' => $subjectType,
                'subject_id'   => $subjectId,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }

        return true;
    }

    /**
     * Update tags against a subject(wiki, page).
     *
     * @param $tags        array
     * @param $subjectType string
     * @param $subjectId   integer
     * @return bool
     */
    public function updateTags($tags, $subjectType, $subjectId)
    {
        DB::table('page_tags')->where('subject_type', $subjectType)->where('subject_id', $subjectId)->delete();

        foreach ($tags as $inputTag) {
            if (gettype($inputTag) === 'string' && (int)$inputTag === 0) {
                $tag = $this->create([
                    'name' => $inputTag,
                ]);
            }

            DB::table('page_tags')->insert([
                'tag_id'       => isset($tag) ? $tag->id : $inputTag,
                'subject_type' => $subjectType,
                'subject_id'   => $subjectId,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }

        return true;
    }

    /**
     * Filter Tags.
     *
     * @param $query
     * @return mixed
     */
    public function filterTags($query)
    {
        return $this->where('name', 'like', '%' . $query . '%')->get();
    }
}
