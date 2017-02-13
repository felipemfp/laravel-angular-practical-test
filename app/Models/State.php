<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    const NORTE = 'Norte';
    const NORDESTE = 'Nordeste';
    const SUL = 'Sul';
    const CENTRO_OESTE = 'Centro-Oeste';
    const SUDESTE = 'Sudeste';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'region'
    ];
}
