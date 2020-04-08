<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
    protected $table = 'warehouse_stocks';
    protected $fillable = ['item_id','qty'];
}
