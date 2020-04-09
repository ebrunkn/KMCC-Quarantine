<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';
    protected $fillable = ['user_id','building_id','room_no','type_id', 'food_time_id', 'food_cuisine_id', 'warehouse_item_id', 'requested_qty', 'fulfilled_qty', 'info'];


    public function scopeWarehouse($query){
        return $query->where('type_id',1);
    }

    public function scopeFood($query){
        return $query->where('type_id',2);
    }

    public function scopeMaintennace($query){
        return $query->where('type_id',3);
    }

    public function scopeOther($query){
        return $query->where('type_id',4);
    }

    public function getBuilding(){
        return $this->hasOne('App\Model\Building','id','building_id');
    }

    public function getRequestType(){
        return $this->hasOne('App\Model\RequestType','id','type_id');
    }

    public function getFoodTime(){
        return $this->hasOne('App\Model\Foodtime','id','food_time_id');
    }

    public function getFoodCuisine(){
        return $this->hasOne('App\Model\FoodCuisine','id','food_cuisine_id');
    }

    public function getWarehouseItem(){
        return $this->hasOne('App\Model\Warehouse','id','warehouse_item_id');
    }

}
