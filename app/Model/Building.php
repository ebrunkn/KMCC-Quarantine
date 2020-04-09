<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    use SoftDeletes;
    
    protected $table = 'buildings';
    protected $fillable = ['building_name','total_rooms','occupancy'];

    public function getContacts(){
        return $this->hasMany('App\Model\BuildingContact','building_id','id');
    }
}
