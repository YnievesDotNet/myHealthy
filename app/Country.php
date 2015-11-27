<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_country', 'languaje_id', 'name', 'lat', 'long', 'active'];
}