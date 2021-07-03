<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    protected $table = "Appointments";
    protected $fillable = ['mobile', 'user_email'];
    protected $hidden = ['id', 'created_at', 'vet_id', 'updated_at', 'shedule_id'];

    public function user()
    {
        return $this->belongsTo('App\Puser',);
    }

    public function shedule()
    {
        return $this->belongsTo('App\Schedule');
    }
}
