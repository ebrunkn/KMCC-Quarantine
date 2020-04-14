<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Building;
use App\Model\RequestType;
use App\Model\FoodTime;
use App\Model\FoodCuisine;
use App\Model\Requirement;
use App\Model\User;
use App\Model\Warehouse;
use App\Model\LogReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RequirementController extends Controller
{
    public function index(Request $request, $type=false){
        $data_bundle = [];
        $query = Requirement::whereNotNull('type_id');

        if($type == 'warehouse'){
            $query->where('type_id',1);
        }elseif($type == 'food'){
            $query->where('type_id',2);
        }elseif($type == 'maintenance'){
            $query->where('type_id',3);
        }elseif($type == 'other'){
            $query->where('type_id',4);
        }

        $query->orderBy('id', 'desc');

        $data_bundle['items'] = $query->paginate(20);
        // dd($data_bundle['items']);
        $view = 'admin.requirement.index';
        switch ($type) {
            case 'food':
                $view = 'admin.requirement.food.index';
            break;

            case 'warehouse':
                $view = 'admin.requirement.warehouse.index';
            break;

            case 'warehouse':
                $view = 'admin.requirement.maintenance.index';
            break;

            default:
                $view = 'admin.requirement.index';
            break;
        }
        return view($view, compact('data_bundle'));
    }

    public function create(Request $request, $type = false){
        $data_bundle = [];

        if($type) {
            if($type == 'warehouse'){
                $type_id = 1;
            }elseif($type == 'food'){
                $type_id = 2;
            }elseif($type == 'maintenance'){
                $type_id = 3;
            }elseif($type == 'other'){
                $type_id = 4;
            }
            $data_bundle['type_id'] = RequestType::find($type_id);
        }
        $data_bundle['request_types'] = RequestType::pluck('type', 'id');
        $data_bundle['food_times'] = FoodTime::pluck('name', 'id');
        $data_bundle['food_cuisines'] = FoodCuisine::pluck('name', 'id');
        $data_bundle['buildings'] = Building::pluck('building_name', 'id');
        $data_bundle['ware_house_items'] = Warehouse::pluck('item_name', 'id');
        // dd($data_bundle);
        $view = 'admin.requirement.create';
        switch ($type) {
            case 'food':
                $view = 'admin.requirement.food.create';
            break;

            case 'warehouse':
                $view = 'admin.requirement.warehouse.create';
            break;

            case 'warehouse':
                $view = 'admin.requirement.maintenance.create';
            break;

            default:
                $view = 'admin.requirement.create';
            break;
        }
        return view($view, compact('data_bundle'));
    }

    public function save(Request $request, $id=false){
        //save
        $message = [
            'building_id.required'=>'Building name field is required',
            'type_id.required'=>'Request type is required',
            'food_time_id.required_if'=>'Food time is required for food request',
            'food_cuisine_id.required_if'=>'Cuisine is required for food request',
            'warehouse_item_id.required_if'=>'Item is required for warehouse request',
            'requested_qty.required_if'=>'Quantity is required for food & warehouse request',
        ];

        $validationRule = array(
            'building_id'=>'required',
            'type_id'=>'required',
            'food_time_id'=>'required_if:type_id,2',
            'food_cuisine_id'=>'required_if:type_id,2',
            'warehouse_item_id'=>'required_if:type_id,1',
            'requested_qty'=>'required_if:type_id,1|required_if:type_id,2',
            // 'assigned_user'=>'exists:users,id',
        );

		$validation = Validator::make($request->input(), $validationRule, $message);

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
                $item->building_id = $request->input('building_id');
                $item->food_time_id = $request->input('food_time_id');
                $item->food_cuisine_id = $request->input('food_cuisine_id');
                $item->warehouse_item_id = $request->input('warehouse_item_id');
                $item->requested_qty = $request->input('requested_qty');
                $item->assigned_user = $request->input('assigned_user') ?? null;
                
                if($request->input('assigned_user')){
                    $item->assigned_time = Carbon::now();
                }

                $fulfilled_qty = $request->input('fulfilled_qty');

                //@todo Check if enough stock. Otherwise set fulfilled to available stock.
                $item->fulfilled_qty = $fulfilled_qty;

                $status = 0;
                if ($request->input('fulfilled_qty') > 0);
                    $status = 1;
                if ($request->input('fulfilled_qty') == $request->input('requested_qty'))
                    $status = 2;

                $item->status = $status;

                $item->save();

                LogReport::create(array(
                    'user_id'=>auth()->user()->id,
                    'type'=>'edit requirement request',
                    'data'=> $item,
                ));
            }else{

                $request->merge(array(
                    'user_id'=>auth()->user()->id,
                ));

                $item = Requirement::create($request->input());
                LogReport::create(array(
                    'user_id'=>auth()->user()->id,
                    'type'=>'add requirement request',
                    'data'=> $item,
                ));

            }

            $request->session()->flash('form-save', true);

            return response()->json([
				'code' => 200,
				'status' => 'OK',
				'message' => 'Data Saved',
            ], 200);

        }
    }

    public function edit(Request $request, $type, $id) {
        $data_bundle = [];
        $data_bundle['item'] = Requirement::findOrFail($id);
        $data_bundle['item']->visited = 1;
        $data_bundle['item']->save();

        $data_bundle['request_types'] = RequestType::pluck('type', 'id');
        $data_bundle['food_times'] = FoodTime::pluck('name', 'id');
        $data_bundle['food_cuisines'] = FoodCuisine::pluck('name', 'id');
        $data_bundle['buildings'] = Building::pluck('building_name', 'id');
        $data_bundle['ware_house_items'] = Warehouse::pluck('item_name', 'id');

        $data_bundle['volunteers'] = User::pluck('name','id');

        $view = 'admin.requirement.edit';
        switch ($type) {
            case 'food':
                $view = 'admin.requirement.food.edit';
            break;

            case 'warehouse':
                $view = 'admin.requirement.warehouse.edit';
            break;

            case 'warehouse':
                $view = 'admin.requirement.maintenance.edit';
            break;

            default:
                $view = 'admin.requirement.edit';
            break;
        }
        return view($view, compact('data_bundle'));
    }

    public function updateStatus(Request $request, $id, $status){
        // delete
        Requirement::where('id', $id)->update(['status' => $status]);
        LogReport::create(array(
            'user_id'=>auth()->user()->id,
            'type'=>'Update status',
            'data'=> $id,
            // 'data'=> ['id' => $id, 'status' => $status],
        ));
        return redirect()->back()->with('form-save', true);;
    }

    public function delete(Request $request, $id){
        // delete
        Requirement::where('id', $id)->delete();
        LogReport::create(array(
            'user_id'=>auth()->user()->id,
            'type'=>'delete requirement request',
            'data'=> $id,
        ));
        return redirect()->back()->with('item-delete', true);
    }

    public function view(Request $request, $id){
        $data_bundle = [];
        $data_bundle['item'] = Requirement::findOrFail($id);
        $data_bundle['item']->visited = 1;
        $data_bundle['item']->save();
        return view('admin.requirement.view', compact('data_bundle'));
    }
}
