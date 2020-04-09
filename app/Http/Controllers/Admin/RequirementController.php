<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Requirement;
use App\Model\LogReport;
use Illuminate\Support\Facades\Validator;

class RequirementController extends Controller
{
    public function index(Request $request){
        $data_bundle = [];
        $data_bundle['items'] = Requirement::paginate(20);
        // dd($data_bundle['requirements']);
        return view('admin.requirement.index', compact('data_bundle'));
    }

    public function create(Request $request){
        return view('admin.requirement.create');
    }

    public function save(Request $request, $id=false){
        //save
        $validationRule = array(
            'building_id'=>'required',
            'type_id'=>'required',
            'food_time_id'=>'required_if:type_id,2',
            'food_cuisine_id'=>'required_if:type_id,2',
            'warehouse_item_id'=>'required_if:type_id,1',
            'requested_qty'=>'required_if:type_id,1|required_if:type_id,2',
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
                $item = Requirement::find($id);
                // $item->item_name = $request->input('item_name');
                $item->save();

                LogReport::create(array(
                    'user_id'=>auth()->user()->id,
                    'type'=>'edit requirement request',
                    'data'=> $item,
                ));
            }else{

                // $request->merge(array(
                //     'threshold'=> $request->input('threshold') ?? 25,
                // ));

                $item = Requirement::create($request->input());
                LogReport::create(array(
                    'user_id'=>auth()->user()->id,
                    'type'=>'add requirement request',
                    'data'=> $item,
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
        $data_bundle = [];
        $data_bundle['item'] = Requirement::findOrFail($id);
        return view('admin.requirement.edit', compact('data_bundle'));
    }

    public function delete(Request $request, $id){
        // delete
        Requirement::where('id', $id)->delete();
        LogReport::create(array(
            'user_id'=>auth()->user()->id,
            'type'=>'delete requirement request',
            'data'=> $id,
        ));
        return redirect()->back();
    }

    public function view(Request $request, $id){
        $data_bundle = [];
        $data_bundle['item'] = Requirement::findOrFail($id);
        return view('admin.requirement.view', compact('data_bundle'));
    }
}
