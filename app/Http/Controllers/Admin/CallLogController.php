<?php

namespace App\Http\Controllers\Admin;

use App\Model\CallLogMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CallLog;
use App\Model\Emirate;
use App\Model\LogReport;
use Illuminate\Support\Facades\Validator;

class CallLogController extends Controller
{

    public function index(Request $request)
    {
        $data_bundle = [];
        $query = CallLog::orderBy('updated_at','desc');
        if($request->has('mobile') && $request->mobile != ''){
            $query->where('mobile','like','%'.$request->mobile.'%');
        }
        $data_bundle['items'] = $query->paginate(20);
        // dd($data_bundle['items']);
        return view('admin.callLog.index', compact('data_bundle'));
    }

    public function create(Request $request)
    {
        $data_bundle['emirates'] = Emirate::pluck('name', 'id');
        return view('admin.callLog.create', compact('data_bundle'));
    }

    public function view(Request $request, $id) {
        $data_bundle = [];
        $data_bundle['item'] = CallLog::findOrFail($id);
        // dd($data_bundle['item']->getMessages);
        return view('admin.callLog.view', compact('data_bundle'));
    }

    public function edit(Request $request, $id) {
        $data_bundle = [];
        $data_bundle['item'] = CallLog::findOrFail($id);
        $data_bundle['emirates'] = Emirate::pluck('name', 'id');
        return view('admin.callLog.edit', compact('data_bundle'));
    }

    public function save(Request $request, $id = false)
    {
        $validationRule = array(
            'name' => 'required',
            'mobile' => 'required',
            'emirate' => 'required',
            'message' => 'required',
            'residence_type' => 'required',
            'covid_tested' => 'required',
            'follow_up_status' => 'required',
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
            if ($id) {
                $item = CallLog::find($id);
                $item->name = $request->input('name');
                $item->mobile = $request->input('mobile');
                $item->dob = $request->input('dob');
                $item->emirate = $request->input('emirate');
                $item->address = $request->input('address');
                $item->nationality = $request->input('nationality');
                $item->residence_type = $request->input('residence_type');
                $item->contact_time = $request->input('contact_time');
                $item->follow_up_status = $request->input('follow_up_status');
                $item->covid_tested = $request->input('covid_tested');
                $item->save();

                $message = new CallLogMessage();
                $message->call_log_id = $id;
                $message->user_id = auth()->user()->id;
                $message->message = $request->input('message');

                $message->save();

                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'edit callLog item',
                    'data' => $item,
                ));

                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'added callLog message',
                    'data' => $message,
                ));
            } else {
                $request->merge(array(
                    'user_id'=> auth()->user()->id,
                ));
                $item = CallLog::create($request->input());
                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'add callLog item',
                    'data' => $item,
                ));

                $message = new CallLogMessage();
                $message->call_log_id = $item->id;
                $message->user_id = auth()->user()->id;
                $message->message = $request->input('message');

                $message->save();

                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'added callLog message',
                    'data' => $message,
                ));
            }

            $request->session()->flash('form-save', true);

            return response()->json([
				'code' => 200,
				'status' => 'OK',
				'message' => 'Call Log Saved',
            ], 200);
        }
    }

    public function delete(Request $request, $id)
    {
        CallLog::where('id', $id)->delete();
        LogReport::create(array(
            'user_id' => auth()->user()->id,
            'type' => 'delete callLog',
            'data' => $id,
        ));

        return redirect()->back()->with('item-delete', true);
    }
}
