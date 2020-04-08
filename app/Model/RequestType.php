<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    protected $table = 'request_types';
    protected $fillable = ['type'];
}
