<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';

    protected $fillable = [
        'prefix', 'description', 'model',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
