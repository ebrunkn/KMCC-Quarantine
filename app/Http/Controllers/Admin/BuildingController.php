<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Model\Building;
use App\Model\BuildingContact;

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
            'name'=>'array',
			'phone'=>'array',
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
                $building->name = $request->input('building_name');
                $building->total_rooms = $request->input('total_rooms');
                $building->occupancy = $request->input('occupancy');
                $user->save();
            }else{
                $building = Building::create(array(
                    'building_name'=> $request->input('building_name'),
                    'total_rooms'=> $request->input('total_rooms'),
                    'occupancy'=> $request->input('occupancy'),
                ));

                $contacts = [];

                foreach($request->input('name') as $index=>$name){
                    // Log::info($name);
                    $contacts[] = [
                        'building_id'=>$building->id,
                        'name'=>$name,
                        'phone'=>$request->input('name')[$index],
                        'created_at'=>Carbon::now(),
                        'updated_at'=>Carbon::now(),
                    ];
                }    
                
                BuildingContact::insert($contacts);
                
            }
            
            return response()->json([
				'code' => 200,
				'status' => 'OK',
				'message' => 'Data Saved',
            ], 200);
            
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
