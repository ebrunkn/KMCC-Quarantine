<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoorDelivery extends Model
{
    use SoftDeletes;

    protected $table = 'door_deliveries';
    protected $fillable = ['user_id','request_id','warehouse_item_id','building_id','room_no','quantity','note'];

    public function getRequirement(){
        return $this->hasOne('App\Model\Requirement','id','request_id');
    }
  
}
