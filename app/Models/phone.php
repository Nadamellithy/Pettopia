<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    protected $table ="phone";
    protected $fillable =['code','phone','vet_id'];
    //protected $hidden =['vet_id'];
    use HasFactory;
    ###relations######
public function vet()
{
    return $this->belongsTo('App\Models\vet','vet_id');
}
}
