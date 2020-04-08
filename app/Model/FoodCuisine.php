<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FoodCuisine extends Model
{
    protected $table = 'food_cuisines';
    protected $fillable = ['name'];
}
