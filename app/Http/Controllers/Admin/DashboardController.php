<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $data_bundle = [];
        
        $data_bundle['food_request'] = [
            'received'=>0,
            'completed'=>0,
            'pending'=>0,
        ];

        $data_bundle['warehouse_request'] = [
            'received'=>0,
            'completed'=>0,
            'pending'=>0,
        ];

        $data_bundle['maintenence_request'] = [
            'received'=>0,
            'completed'=>0,
            'pending'=>0,
        ];
        return view('admin/dashboard/index', compact('data_bundle'));
    }
}
