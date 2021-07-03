<?php

namespace App\Models;

use App\Puser;
use Illuminate\Database\Eloquent\Model;


class Ppet extends Model
{
    protected $table="ppets";
    protected $fillable=['name','age', 'gender','color','bread','photo' ,'diseases','vaccinations','type','user_id','section'];
    protected $hidden=['created_at','updated_at'];
    public function user()
    {
        return $this->belongsTo(Puser::class,);

    }


}
