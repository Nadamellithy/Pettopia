<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Shelter extends Model
{
    protected $table ="Shelter";
    protected $fillable=['id','name','details','location'];
    protected $hidden=['created_at','updated_at'];
}
