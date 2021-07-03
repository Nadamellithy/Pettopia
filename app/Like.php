<?php

namespace App;

use App\Models\Ppost;
use Illuminate\Database\Eloquent\Model;


class Like extends Model
{
    protected $table="Likes";
    protected $fillable=['id','post_id','user_id'];
    public function user()
    {
        return $this->belongsTo('App\Puser','user_id');
    }
    public function post()
    {
        return $this->belongsTo('App\Models\Ppost');
    }
    public static function withTrashed()
    {
    }
}
