<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    protected $table = 'constituencies';
    protected $fillable = ['district_id','name'];

    // $ar = [
    //     'Manjeshwaram',
    //     'Kasaragod',
    //     'Udma',
    //     'Kanhangad',
    //     'Thrikaripur',
    //     'Payyanur',
    //     'Kalliasseri',
    //     'Taliparamba',
    //     'Irikkur',
    //     'Azhikode',
    //     'Kannur',
    //     'Dharmadom',
    //     'Thalassery',
    //     'Kuthuparamba',
    // ];
    
}
