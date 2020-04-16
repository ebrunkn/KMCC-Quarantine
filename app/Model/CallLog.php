<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    protected $fillable = ['user_id', 'name', 'mobile', 'nationality', 'dob', 'residence_type', 'contact_time', 'follow_up_status', 'covid_tested', 'emirate', 'address', 'remarks'];

    public function getEmirate(){
        return $this->hasOne('App\Model\Emirate','id','emirate');
    }
}
