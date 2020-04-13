<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Requirement;
use App\Model\DoorDelivery;
use App\Model\LogReport;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{

    public function index(Request $request){
        $data_bundle = [];
        $data_bundle['requirements'] =  Requirement::assigned()->orderBy('updated_at','desc')->paginate(20);
        return view('admin.delivery.index', compact('data_bundle'));
    }

    public function viewRequirement(Request $request, $id){
        $data_bundle = [];
        $data_bundle['requirement'] =  Requirement::assigned()->where('id',$id)->first();
        return view('admin.delivery.view-requirement', compact('data_bundle'));
    }

    public function create(Request $request){
        return view('admin.delivery.create');
    }
}
