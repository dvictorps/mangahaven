<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;


    protected $casts = [

        'tags' => 'array'

    ];

    protected $dates = ['date'];

    public function user(){

        return $this->belongsTo('App\Models\User');

    }

    protected $guarded = [];

    public function users(){
        return $this->belongsToMany('App\Models\User');

    }


   

}
