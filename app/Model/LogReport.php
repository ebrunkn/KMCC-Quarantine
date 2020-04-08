<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LogReport extends Model
{
    protected $table = 'log_reports';
    protected $fillable = ['user_id','type','data'];
}
