<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';
    protected $fillable = ['item_name'];
}
