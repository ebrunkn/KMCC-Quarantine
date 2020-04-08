<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    protected $fillable = ['item_name'];

    public function getStocks(){
        return $this->hasMany('App\Model\WarehouseStock','item_id','id');
    }
}
