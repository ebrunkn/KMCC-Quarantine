<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Model\Warehouse;
use App\Model\WarehouseStock;
use App\Model\LogReport;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function index(Request $request){
        $data_bundle = [];
        $data_bundle['items'] = Warehouse::paginate(20);
        // dd($data_bundle['items']);
        return view('admin.warehouse.index', compact('data_bundle'));
    }

    public function create(Request $request){
        return view('admin.warehouse.create');
    }

    public function save(Request $request, $id=false){
        //save
        $validationRule = array(
            'item_name'=>'required',
			// 'threshold'=>'required',
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
                $item = Warehouse::find($id);
                $item->item_name = $request->input('item_name');
                $item->save();

                LogReport::create(array(
                    'user_id'=>auth()->user()->id,
                    'type'=>'edit warehouse item',
                    'data'=> $item,
                ));
            }else{

                $request->merge(array(
                    'threshold'=> $request->input('threshold') ?? 25,
                ));

                $item = Warehouse::create($request->input());
                LogReport::create(array(
                    'user_id'=>auth()->user()->id,
                    'type'=>'add warehouse item',
                    'data'=> $item,
                ));

                // dd($request->input());

                if($request->input('qty')){
                    $data = WarehouseStock::create(array(
                        'item_id'=> $item->id,
                        'qty'=> $request->input('qty'),
                    ));
                    LogReport::create(array(
                        'user_id'=>auth()->user()->id,
                        'type'=>'add warehouse stock',
                        'data'=> $data,
                    ));
                }

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
        $data_bundle['item'] = Warehouse::findOrFail($id);
        return view('admin.warehouse.edit', compact('data_bundle'));
    }

    public function addStock(Request $request, $id) {
        $data_bundle = [];
        $data_bundle['item'] = Warehouse::findOrFail($id);
        return view('admin.warehouse.add-stock', compact('data_bundle'));
    }

    public function addStockSave(Request $request, $id) {
        $validationRule = array(
			'item_id'=>'required',
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
            $data = WarehouseStock::create(array(
                'item_id'=> $request->input('item_id'),
                'qty'=> $request->input('qty'),
            ));

            LogReport::create(array(
                'user_id'=>auth()->user()->id,
                'type'=>'add warehouse stock',
                'data'=> $data,
            ));

            return response()->json([
				'code' => 200,
				'status' => 'OK',
				'message' => 'Data Saved',
            ], 200);
        }
    }

    public function delete(Request $request, $id){
        // delete
        Warehouse::where('id', $id)->delete();
        LogReport::create(array(
            'user_id'=>auth()->user()->id,
            'type'=>'delete warehouse item',
            'data'=> $id,
        ));
        return redirect()->back();
    }

    public function view(Request $request, $id){
        $data_bundle = [];
        $data_bundle['item'] = Warehouse::findOrFail($id);
        return view('admin.warehouse.view', compact('data_bundle'));
    }
}
