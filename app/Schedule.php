<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vet;


class Schedule extends Model
{
    protected $table ="schedule";
    protected $fillable=['date','day','start_time','end_time','vet_id'];
    protected $hidden=['id','created_at','updated_at'];
    public function vets()
    {
        return $this->belongsTo('App\Vet','vet_id');

    }
    public function appointment()
    {
        return $this->hasMany('App\Appointment','shedule_id');

    }
}
