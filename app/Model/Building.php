<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    use SoftDeletes;
    
    protected $table = 'buildings';
    protected $fillable = ['building_name','emirate_id','total_rooms','occupancy'];

    public function scopeAuthEmirate($query){
        if(auth()->user()->emirate_id){
            return $query->where('emirate_id',auth()->user()->emirate_id);
        }
        return;
    }

    public function getContacts(){
        return $this->hasMany('App\Model\BuildingContact','building_id','id');
    }
}
