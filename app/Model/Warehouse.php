<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    
    protected $table = 'warehouses';
    protected $fillable = ['item_name','threshold', 'emirate_id'];

    public function scopeAuthEmirate($query){
        if(auth()->user()->emirate_id){
            return $query->where('emirate_id',auth()->user()->emirate_id);
        }
        return;
    }

    public function getTotalStockAttribute(){
        $sum = $this->getStocks()->withoutRestock()->sum('qty');
        return $sum ?? 0;
    }

    public function getCurrentStockAttribute(){
        $sum = $this->getStocks()->withoutRestock()->sum('qty');
        return ($sum - $this->fullfilled_sum) ?? 0;
    }

    public function getIsThresholdAttribute(){
        if($this->current_stock <= $this->threshold && $this->current_stock > 0){
            return true;
        }
        return false;
    }

    public function getIsStockoutAttribute(){
        if($this->current_stock <= 0){
            return true;
        }
        return false;
    }

    public function getIsOverRequestAttribute(){
        if($this->current_stock <= $this->pending_requested_sum){
            return true;
        }
        return false;
    }

    //Virtualf field for total sum of fullfilled quantitiy of a warehouse item
    public function getFullfilledSumAttribute(){
        $sum = $this->getWarehouseRequirements()->sum('fulfilled_qty');
        return $sum ?? 0;
    }

    //Virtualf field for total sum of requested quantitiy of a warehouse item
    public function getRequestedSumAttribute(){
        $sum = $this->getWarehouseRequirements()->sum('requested_qty');
        return $sum ?? 0;
    }

    //Virtualf field for total sum of requested quantitiy (not finshed) of a warehouse item
    public function getPendingRequestedSumAttribute(){
        $sum = $this->getWarehouseRequirements()->where('status','<', 2)->sum('requested_qty');
        return $sum ?? 0;
    }

    public function getStocks(){
        return $this->hasMany('App\Model\WarehouseStock','item_id','id');
    }

    public function getWarehouseRequirements(){
        return $this->hasMany('App\Model\Requirement','warehouse_item_id','id');
    }
    
}
