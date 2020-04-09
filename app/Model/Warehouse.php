<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    
    protected $table = 'warehouses';
    protected $fillable = ['item_name','threshold'];

    public function getTotalStockAttribute(){
        $sum = $this->getStocks()->withoutRestock()->sum('qty');
        return $sum ?? 0;
    }

    public function getStocks(){
        return $this->hasMany('App\Model\WarehouseStock','item_id','id');
    }
    
}
