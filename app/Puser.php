<?php
namespace App;
use App\Pcomment;
use App\Like;
use App\Models\Ppost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Product;

class Puser extends Authenticatable implements JWTSubject
    //implements JWTSubject
{
  // use Notifiable,HasApiTokens;
    protected $table="Pusers";
    protected $fillable=['name','e_mail', 'phone','gender','photo','password' ,'age'];
    protected $hidden = ['password', 'remember_token',];
    public function posts()
    {
        return $this->hasMany(Ppost::class,'user_id');
    }

    public function pets()
    {
        return $this->hasMany(Ppet::class,'user_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Pcomment','user_id');
    }
    public function appointment()
    {
        return $this->hasMany('App\Appointment','user_id');
    }
    public function products()
    {
        return $this->hasMany('App\Product','user_id');
    }
    public function likes()
    {
        return $this->hasMany('App\Like','user_id');
    }

















    protected $casts = [
       'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
    }

    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
    }
}
