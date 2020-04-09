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
            'total'=> Building::count(),
        ];

        $data_bundle['food_request'] = [
            'received'=>Requirement::food()->count(),
            'completed'=>Requirement::food()->completed()->count(),
            'pending'=>Requirement::food()->pending()->count(),
            'processing'=>Requirement::food()->processing()->count(),
        ];

        $data_bundle['warehouse_request'] = [
            'received'=>Requirement::warehouse()->count(),
            'completed'=>Requirement::warehouse()->fullfilled()->count(),
            'pending'=>Requirement::warehouse()->unFullfilled()->count(),
        ];

        $data_bundle['maintenence_request'] = [
            'received'=>Requirement::maintennace()->count(),
            'completed'=>Requirement::maintennace()->completed()->count(),
            'pending'=>Requirement::maintennace()->pending()->count(),
            'processing'=>Requirement::maintennace()->processing()->count(),
        ];

        // dd($data_bundle);
        return view('admin/dashboard/index', compact('data_bundle'));
    }
}
