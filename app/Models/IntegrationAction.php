<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IntegrationAction
 *
 * @package App\Models
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 */
class IntegrationAction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'integration_actions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'updated_at', 'created_at',
    ];
}
