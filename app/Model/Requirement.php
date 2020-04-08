<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';
    protected $fillable = ['user_id','building_id','type', 'warehouse_item_id', 'requested_qty', 'fulfilled_qty', 'info'];
}
