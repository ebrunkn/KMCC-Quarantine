<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FoodTime extends Model
{
    protected $table = 'food_times';
    protected $fillable = ['name'];
}
