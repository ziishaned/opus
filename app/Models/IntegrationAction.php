<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrationAction extends Model
{
    protected $table = 'integration_actions';

    protected $fillable = [
        'name',
        'updated_at',
        'created_at',
    ];
}
