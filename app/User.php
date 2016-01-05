<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin() {
        return $this->is_admin == True;
    }
    public function isReception(){
        return $this->is_reception;
    }
    public function Goods(){
        return $this->belongsToMany('\App\Goods','goods_user','user_id','goods_id')->withTimestamps();
    }
    public function Award(){
        return $this->belongsToMany('\App\Award','award_user','user_id','award_id')->withTimestamps();
    }
    public function Items(){
        return $this->belongsToMany('\App\Item','item_users','user_id','item_id')->withTimestamps();
    }
    public function GoodsUser(){
        return $this->hasMany('\App\GoodsUser','user_id','id');
    }
    public function AwardUser(){
        return $this->hasMany('\App\AwardUser','user_id','id');
    }
}
