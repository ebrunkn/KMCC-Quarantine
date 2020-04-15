<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const DEVELOPER = 0; 
    const GLOBAL_ADMIN = 1; 
    const ADMIN = 2; 
    const VOLUNTEER = 3; 
    // const WAREHOUSE_MANAGER = 4; 
    // const FOOD_MANAGER = 5; 

    protected $guard = 'web';

    protected $fillable = [
        'name', 'email', 'password','role_id','emirate_id','state_id','district_id','constituency_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeAuthEmirate($query){
        if(auth()->user()->emirate_id){
            return $query->where('emirate_id',auth()->user()->emirate_id);
        }
        return;
    }

    public function scopeVolunteer($query){
        return $query->where('role_id',self::VOLUNTEER);
    }

    public function getDistrict(){
        return $this->hasOne('App\Model\District','id','district_id');
    }

    public function getConstituency(){
        return $this->hasOne('App\Model\Constituency','id','constituency_id');
    }
}
