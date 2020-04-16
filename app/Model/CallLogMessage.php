<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CallLogMessage extends Model
{
    protected $fillable = ['call_log_id', 'message', 'user_id'];

    public function getUser(){
        return $this->hasOne('App\Model\User','id','user_id');
    }
}
