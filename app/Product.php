<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $table="products";
    protected $fillable=['id','name','price', 'user_id','description','location','photo'];
    protected $hidden=['created_at','updated_at'];
    public function user()
    {
        return $this->belongsTo(Puser::class,);

    }
}
