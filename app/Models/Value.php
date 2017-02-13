<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data', 'state_id', 'year', 'dataset_id'
    ];
}
