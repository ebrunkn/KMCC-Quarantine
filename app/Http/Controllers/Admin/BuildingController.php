<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Model\Building;

// Requests
use App\Http\Requests\BuildingRequest;

class BuildingController extends Controller
{
    public function index(Request $request){
        $data_bundle = [];
        $data_bundle['buildings'] = Building::paginate(20);
        // dd($data_bundle['buildings']);
        return view('admin.building.index', compact($data_bundle));
    }

    public function create(Request $request){
        return view('admin.building.create');
    }

    public function save(Request $request, $id=false){
        //save
        $validationRule = array(
            'building_name'=>'required',
			'total_rooms'=>'required',
            'occupancy'=>'required',
            'name'=>'required',
			'phone'=>'required',
		);
        
		$validation = Validator::make($request->input(), $validationRule);
        
		if ($validation->fails()) {
			return response()->json([
				'code' => 400,
				'status' => 'INVALID_DATA',
				'errors' => $validation->errors(),
				'message' => $validation->errors(),
			], 200);
		} else {
            // $validated = $request->validated();
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
        }
        
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
