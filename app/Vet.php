<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{

    protected $table ="vets";
    protected $fillable=['name','age','phone','description','location'];
    protected $hidden=['password','e_mail','created_at','updated_at'];

    public function shedule(){
        return $this->hasMany('App\Schedule');
    }

}
