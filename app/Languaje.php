<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languaje extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languajes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name', 'active'];
}