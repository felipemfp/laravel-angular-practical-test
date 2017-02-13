<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desription', 'url', 'year_start', 'year_end',
        'coverage', 'periodicity', 'updated_date', 'source_provider_id',
        'source_manager_id', 'group_id', 'authority_id'
    ];

    public function sourceManager()
    {
      return $this->belongsTo('App\Models\Source', 'source_manager_id');
    }

    public function sourceProvider()
    {
      return $this->belongsTo('App\Models\Source', 'source_provider_id');
    }

    public function group()
    {
      return $this->belongsTo('App\Models\Group');
    }

    public function authority()
    {
      return $this->belongsTo('App\Models\Authority');
    }

    public function values()
    {
      return $this->hasMany('App\Models\Value');
    }
}
