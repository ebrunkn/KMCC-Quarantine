<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    protected $table = 'constituencies';
    protected $fillable = ['district_id','name'];    
}
