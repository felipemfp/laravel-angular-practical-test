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

    /**
     * Get the source manager for the dataset.
     *
     * @return App\Models\Source
     */
    public function sourceManager()
    {
      return $this->belongsTo('App\Models\Source', 'source_manager_id');
    }

    /**
     * Get the source provider for the dataset.
     *
     * @return App\Models\Source
     */
    public function sourceProvider()
    {
      return $this->belongsTo('App\Models\Source', 'source_provider_id');
    }

    /**
     * Get the group for the dataset.
     *
     * @return App\Models\Group
     */
    public function group()
    {
      return $this->belongsTo('App\Models\Group');
    }

    /**
     * Get the authority for the dataset.
     *
     * @return App\Models\Authority
     */
    public function authority()
    {
      return $this->belongsTo('App\Models\Authority');
    }

    /**
     * Get the values for the dataset.
     *
     * @return Illuminate\Support\Collection
     */
    public function values()
    {
      return $this->hasMany('App\Models\Value');
    }
}
