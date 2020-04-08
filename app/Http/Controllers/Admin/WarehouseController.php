<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Model\Warehouse;
use App\Model\WarehouseStock;

class WarehouseController extends Controller
{
    public function index(Request $request){
        $data_bundle = [];
        $data_bundle['items'] = Warehouse::paginate(20);
        // dd($data_bundle['buildings']);
        return view('admin.warehouse.index', compact($data_bundle));
    }

    public function create(Request $request){
        return view('admin.warehouse.create');
    }

    public function save(Request $request, $id=false){
        //save
        $validationRule = array(
            'item_name'=>'required',
			'qty'=>'required',
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
                $building = Warehouse::find($id);
                $building->item_name = $request->input('item_name');
                $user->save();
            }else{
                $item = Warehouse::create(array(
                    'item_name'=> $request->input('item_name'),
                ));

                $building = WarehouseStock::create(array(
                    'item_id'=> $item->id,
                    'qty'=> $request->input('qty'),
                ));
                
            }
            
            return response()->json([
				'code' => 200,
				'status' => 'OK',
				'message' => 'Data Saved',
            ], 200);
            
        }
    }

    public function edit(Request $request, $id) {
        return view('admin.warehouse.edit');
    }

    public function delete(Request $request, $id){
        // delete
    }

    public function view(Request $request, $id){
        return view('admin.warehouse.view');
    }
}
