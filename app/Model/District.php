<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['state_id','name'];

    // $ar = [
    //     'Kasargod',
    //     'Kannur',
    //     'Wayanad',
    //     'Kozhikode',
    //     'Malappuram',
    //     'Palakkad',
    //     'Thrissur',
    //     'Ernakulam',
    //     'Idukki',
    //     'Kottayam',
    //     'Alappuza',
    //     'Pathanamthitta',
    //     'Kollam',
    //     'Thiruvananthapuram',
    // ];
}
