<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PageTags
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class PageTags extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'page_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id', 'subject_id', 'subject_type', 'created_at', 'updated_at',
    ];
}
