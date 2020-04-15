<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    protected $fillable = ['name', 'mobile', 'area', 'address', 'comments'];
}
