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
        $validated = $request->validated();
        if($id){
            $building = Building::find($id);
            $building->name = $validated['name'];
            $building->total_rooms = $validated['total_rooms'];
            $building->occupancy = $validated['occupancy'];
            $user->save();
        }else{
            Building::create(array(
                'name'=> $validated['name'],
                'total_rooms'=> $validated['total_rooms'],
                'occupancy'=> $validated['occupancy'],
            ));
        }
        return redirect(url('buildings'));
        // return response()->json('saved', 200);
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
