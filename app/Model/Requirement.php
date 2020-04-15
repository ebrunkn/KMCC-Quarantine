<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{

    // ===========STATUS CONST===========
    const NEW_ITEM_STATUS = 0;
    const PROCESSING_STATUS = 1;
    const ASSIGNED_STATUS = 2;
    const DELIVERY_STARTED_STATUS = 3;
    const HOLD_STATUS = 4;
    const DELIVERED_STATUS = 5;
    const CANCELLED_STATUS = 6;

    // ===========REQUEST TYPE CONST===========
    const WAREHOUSE_TYPE = 1;
    const FOOD_TYPE = 2;
    const MAINTENANCE_TYPE = 3;
    const OTHER_TYPE = 4;



    protected $table = 'requirements';
    protected $fillable = ['user_id','emirate_id','assigned_user','building_id','room_no','type_id', 'food_time_id', 'food_cuisine_id', 'warehouse_item_id', 'requested_qty', 'fulfilled_qty','status', 'info','visited'];


    public function getTypeAttribute($query){
        switch ($this->type_id) {
            case 1:
                $type = 'warehouse';
                break;

            case 2:
                $type = 'food';
                break;

            case 3:
                $type = 'maintenance';
                break;

            case 4:
                $type = 'other';
                break;

            default:
                $type = 'warehouse';
                break;
        }

        return $type;
    }

    public function getStatusLabelAttribute($query){
        $labels = ['New','Processing','Assigned Volunteer','Delivery Started','On Hold','Delivered', 'Canceled'];
        return $labels[$this->status ?? 'NIL'];
    }

    public function getItemNameAttribute($query){
        if($this->type_id == self::WAREHOUSE_TYPE){
            $item_name = $this->getWarehouseItem['item_name'];
            // dd($item_name);
        }elseif($this->type_id == self::FOOD_TYPE){
            $item_name = $this->getFoodTime['name'] ?? ''. $this->getFoodCuisine['name'] ?? '';
        }
        return $item_name;
    }

    public function getDoorDeliveredSumAttribute(){
        $sum = $this->getDoorDeliveryItems()->sum('quantity');
        return $sum ?? 0;
    }

    public function scopeAssigned($query){
        return $query->where('assigned_user',auth()->user()->id);
    }

    public function scopeDeliveryStarted($query){
        return $query->where('status', self::DELIVERY_STARTED_STATUS);
    }

    public function scopeUnread($query){
        return $query->where('visited',0);
    }

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

    public function scopeCompleted($query){
        return $query->where('status',2);
    }

    public function scopeProcessing($query){
        return $query->where('status',1);
    }

    public function scopePending($query){
        return $query->where('status',0);
    }

    public function scopeFulfilled($query){
        // return $query->where('requested_qty','=','fulfilled_qty');
        $query->whereRaw('requested_qty <= fulfilled_qty');
    }

    public function scopeUnFulfilled($query){
        // return $query->where('requested_qty','!=','fulfilled_qty');
        $query->whereRaw('requested_qty > fulfilled_qty');
    }

    public function getBuilding(){
        return $this->hasOne('App\Model\Building','id','building_id');
    }

    public function getRequestType(){
        return $this->hasOne('App\Model\RequestType','id','type_id');
    }

    public function getFoodTime(){
        return $this->hasOne('App\Model\FoodTime','id','food_time_id');
    }

    public function getFoodCuisine(){
        return $this->hasOne('App\Model\FoodCuisine','id','food_cuisine_id');
    }

    public function getWarehouseItem(){
        return $this->hasOne('App\Model\Warehouse','id','warehouse_item_id');
    }

    public function getDoorDeliveryItems(){
        return $this->hasMany('App\Model\DoorDelivery','request_id','id');
    }

}
