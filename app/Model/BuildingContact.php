<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuildingContact extends Model
{
    use SoftDeletes;
    
    protected $table = 'building_contacts';
    protected $fillable = ['building_id','name','phone'];
}
