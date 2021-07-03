<?php

namespace App;
use App\Puser;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Ppost;

class Pcomment extends Model
{
    protected $table = "Pcomments";
    protected $fillable = ['id', 'post_id', 'user_id', 'comment'];

    public function user()
    {
        return $this->belongsTo('App\Puser',);

    }
    public function post()
    {
        return $this->belongsTo('App\Models\Ppost');
    }

}
