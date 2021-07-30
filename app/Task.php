<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'board_id', 'status'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'               => 'string',
        'board_id'           => 'integer',
        'status'             => 'string'
    ];

        //using a mutator
        public function setNameAttribute($name)
        {
         $name = strtolower(strip_tags($name));
         $this->attributes['name'] =  ucwords($name);
        }
}
