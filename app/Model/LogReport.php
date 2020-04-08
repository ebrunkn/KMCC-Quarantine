<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogReport extends Model
{
    use SoftDeletes;
    
    protected $table = 'log_reports';
    protected $fillable = ['user_id','type','data'];
}
