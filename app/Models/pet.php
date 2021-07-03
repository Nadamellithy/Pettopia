<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pet extends Model
{
    protected $table ="pets";
    protected $fillable =['name','color','vet_id'];
    use HasFactory;
    ####relatiosn1-to-many######
public function vet(){
    return $this->belongsTo('App\Models\vet','vet_id');
}
}
