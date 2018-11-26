<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'year',
        'actors'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['actors.pivot'];

    /**
     * Many2many relation with actors
     */
    public function actors()
    {
        return $this->belongsToMany('App\Actor')->using('App\ActorMovie');
    }
}