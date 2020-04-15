<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CallLog;
use App\Model\LogReport;
use Illuminate\Support\Facades\Validator;

class CallLogController extends Controller
{

    public function index(Request $request)
    {
        $data_bundle = [];
        $data_bundle['items'] = CallLog::paginate(20);
        // dd($data_bundle['items']);
        return view('admin.callLog.index', compact('data_bundle'));
    }

    public function create(Request $request)
    {
        return view('admin.callLog.create');
    }

    public function edit(Request $request, $id) {
        $data_bundle = [];
        $data_bundle['item'] = CallLog::findOrFail($id);
        return view('admin.callLog.edit', compact('data_bundle'));
    }

    public function save(Request $request, $id = false)
    {
        $validationRule = array(
            'name' => 'required',
            'mobile' => 'required',
            'comments' => 'required',
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
                $item->area = $request->input('area');
                $item->address = $request->input('address');
                $item->comments = $request->input('comments');
                $item->save();

                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'edit callLog item',
                    'data' => $item,
                ));
            } else {
                $item = CallLog::create($request->input());
                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'add callLog item',
                    'data' => $item,
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
