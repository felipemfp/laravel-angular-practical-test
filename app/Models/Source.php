<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'url', 'type', 'authority_id'
    ];


    /**
     * Get the authority for the source.
     *
     * @return App\Models\Authority
     */
    public function authority()
    {
      return $this->belongsTo('App\Models\Authority');
    }
}
