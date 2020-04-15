<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Building;
use App\Model\BuildingContact;
use App\Model\Requirement;
use App\Model\LogReport;

class DashboardController extends Controller
{
    public function index(){

        $data_bundle = [];

        $data_bundle['buildings'] = [
            'total'=> Building::authEmirate()->count(),
        ];

        $data_bundle['food_request'] = [
            'received'=>Requirement::authEmirate()->food()->count(),
            'completed'=>Requirement::authEmirate()->food()->completed()->count(),
            'pending'=>Requirement::authEmirate()->food()->pending()->count(),
            'processing'=>Requirement::authEmirate()->food()->processing()->count(),
        ];

        $data_bundle['warehouse_request'] = [
            'received'=>Requirement::authEmirate()->warehouse()->count(),
            'completed'=>Requirement::authEmirate()->warehouse()->fulfilled()->count(),
            'pending'=>Requirement::authEmirate()->warehouse()->unFulfilled()->count(),
        ];

        $data_bundle['maintenence_request'] = [
            'received'=>Requirement::authEmirate()->maintennace()->count(),
            'completed'=>Requirement::authEmirate()->maintennace()->completed()->count(),
            'pending'=>Requirement::authEmirate()->maintennace()->pending()->count(),
            'processing'=>Requirement::authEmirate()->maintennace()->processing()->count(),
        ];

        // dd($data_bundle);
        return view('admin/dashboard/index', compact('data_bundle'));
    }
}
