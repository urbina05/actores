<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'movies'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['pivot'];

    /**
     * Many2many relation with movies, unsed from actor model
     */
    // public function movies()
    // {
    //     return $this->belongsToMany('App\Movies')->using('App\MovieActor');
    // }
}