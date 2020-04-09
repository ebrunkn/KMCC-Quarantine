<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseStock extends Model
{
    use SoftDeletes;
    
    protected $table = 'warehouse_stocks';
    protected $fillable = ['item_id','qty','restock'];

    public function scopeWithoutRestock($query){
        return $query->where('restock',0);
    }

    public function scopeWithRestock($query){
        return $query->where('restock',1);
    }
}
