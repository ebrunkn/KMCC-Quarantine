<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    protected $fillable = ['name', 'mobile', 'nationality', 'dob', 'residence_type', 'contact_time', 'follow_up_status', 'covid_tested', 'emirate', 'address', 'remarks'];
}
