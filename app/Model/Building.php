<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'buildings';
    protected $fillable = ['building_name','total_rooms','occupancy'];

    public function getContacts(){
        return $this->hasMany('App\Model\BuildingContact','building_id','id');
    }
}
