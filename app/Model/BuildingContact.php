<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuildingContact extends Model
{
    protected $table = 'building_contacts';
    protected $fillable = ['building_id','name','phone'];
}
