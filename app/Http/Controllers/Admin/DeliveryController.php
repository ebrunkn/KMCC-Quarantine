<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Requirement;
use App\Model\DoorDelivery;
use App\Model\LogReport;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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

    public function changeStatus(Request $request, $requirement_id ,$status_to){
        $data_bundle = [];
        $data_bundle['requirement'] =  Requirement::assigned()->where('id',$requirement_id)->firstOrFail();
        $exist_current_delivery =  Requirement::assigned()
        ->where('status',Requirement::DELIVERY_STARTED_STATUS)
        ->where('building_id','!=',$data_bundle['requirement']->building_id)
        ->exists();

        // dd($exist_current_delivery); 
        if(!$exist_current_delivery){
            $data_bundle['requirement']->status = 3;
            $data_bundle['requirement']->save();

            return redirect()->back()->with('form-action', ['success','OK...! Started delivery']);
        }else{
            return redirect()->back()->with('form-action', ['error','Sorry...! You cannot deliver on different building at same time.']);
        }
        
        
    }

    public function entry(Request $request){
        $data_bundle = [];
        $data_bundle['requirements'] =  Requirement::assigned()->deliveryStarted()->orderBy('updated_at','desc')->get();
        return view('admin.delivery.entry-form', compact('data_bundle'));
    }

    public function entrySave(Request $request){

        $validationRule = array(
            'room_no' => 'required',
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

            $datat_to_insert = [];

            // dd($request->input());

            foreach($request->input('requirement_id') as $index=>$req_id){

                $existReq = Requirement::assigned()->deliveryStarted()
                ->where('id',$req_id)
                ->where('fulfilled_qty', '>', 0)
                ->first();

                if($existReq){
                    $datat_to_insert[] = [
                        'user_id'=>auth()->user()->id,
                        'request_id'=>$req_id,
                        'room_no'=>$request->input('room_no'),
                        'quantity'=>$request->input('item_count')[$index],
                        'note'=>$request->input('note'),  
                        'created_at'=>Carbon::now(),  
                        'updated_at'=>Carbon::now(),  
                    ];
                }
                
            }

            if(count($datat_to_insert)){
                DoorDelivery::insert($datat_to_insert);
                session()->flash('form-action', ['success','Saved']);
            }else{
                session()->flash('form-action', ['warning','Nothing to deliver']);
            }

            

            // dd(request()->session()->get('form-action')[0]);
            return response()->json([
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Saved',
            ], 200);

        }
        // $data_bundle['requirements'] =  Requirement::assigned()->deliveryStarted()->orderBy('updated_at','desc')->get();

    }

}
