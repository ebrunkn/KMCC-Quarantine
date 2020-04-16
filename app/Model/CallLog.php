<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    protected $fillable = ['user_id', 'name', 'mobile', 'nationality', 'dob', 'residence_type', 'contact_time', 'follow_up_status', 'covid_tested', 'emirate', 'address'];

    const RESIDENCE_FAMILY = 0;
    const RESIDENCE_BACHELOR = 1;
    const RESIDENCE_OTHER = 2;

    const COVID_TESTED_NO = 0;
    const COVID_TESTED_YES = 1;

    const FOLLOW_UP_NO = 0;
    const FOLLOW_UP_YES = 1;
    const FOLLOW_UP_OTHER = 2;

    public function getResidenceAttribute(){
        $labels = ['Family','Bachelor','Other'];
        return $labels[$this->residence_type ?? 'Other'];
    }

    public function getCovidAttribute(){
        $labels = ['No','Yes'];
        return $labels[$this->covid_tested ?? 'No'];
    }

    public function getFollowUpAttribute(){
        $labels = ['No','Yes'];
        return $labels[$this->follow_up_status ?? 'No'];
    }

    public function getEmirate(){
        return $this->hasOne('App\Model\Emirate','id','emirate');
    }

    public function getMessages(){
        return $this->hasMany('App\Model\CallLogMessage');
    }

    public function getUser(){
        return $this->hasOne('App\Model\User','id','user_id');
    }
}
