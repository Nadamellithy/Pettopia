<?php

namespace App\Models;

use App\Puser;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Pcomment;

class Ppost extends Model
{
    protected $table="Pposts";
    protected $fillable=['id','post','user_id'];
    protected $hidden=['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(Puser::class,);

    }
    public function comment()
    {

        return $this->hasMany('App\Pcomment','post_id');

    }
    public function likes()
    {
        return $this->hasMany('App\Like','post_id');
    }
    public static function findOrFail($post_id)
    {
    }
}
