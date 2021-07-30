<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;
use App\User;

class Board extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'user_id'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'title'             => 'string',
        'user_id'           => 'integer'
    ];


    //using a mutator
    public function setTitleAttribute($title)
    {
     $title = strtolower(strip_tags($title));
     $this->attributes['title'] =  ucwords($title);
    }

    //defining relationship with task table
    public function tasks(){

        return $this->hasMany(Task::class,'board_id','id');
    }

    
}
