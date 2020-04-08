<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\BuildingContact;

// Requests
use App\Http\Requests\BuildingContactRequest;

class BuildingContactController extends Controller
{
    public function index(Request $request){
        // 
    }

    public function create(Request $request){
        return view('admin.building.create');
    }

    public function save(BuildingRequest $request, $id=false){
        //save
    }

    public function edit(Request $request, $id) {
        $data_bundle = [];
        $data_bundle['buildings'] = Building::findOrFail($id);
        return view('admin.building.edit',compact($data_bundle));
    }

    public function delete(Request $request, $id){
        // delete
    }

    public function view(Request $request, $id){
        $data_bundle = [];
        $data_bundle['buildings'] = Building::findOrFail($id);
        return view('admin.building.view', compact($data_bundle));
    }
}
