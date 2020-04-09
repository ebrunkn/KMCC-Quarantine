<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Model\Building;
use App\Model\BuildingContact;
use App\Model\LogReport;

// Requests
use App\Http\Requests\BuildingRequest;

class BuildingController extends Controller
{
    public function index(Request $request)
    {
        $data_bundle = [];
        $data_bundle['buildings'] = Building::paginate(20);
        // dd($data_bundle['buildings']);
        return view('admin.building.index', compact('data_bundle'));
    }

    public function create(Request $request)
    {
        return view('admin.building.create');
    }

    public function save(Request $request, $id = false)
    {
        //save
        $validationRule = array(
            'building_name' => 'required',
            'total_rooms' => 'required',
            'occupancy' => 'required',
            'name' => 'array',
            'phone' => 'array',
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
                $building = Building::find($id);
                $building->building_name = $request->input('building_name');
                $building->total_rooms = $request->input('total_rooms');
                $building->occupancy = $request->input('occupancy');
                $building->save();

                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'edit building',
                    'data' => $building,
                ));
            } else {
                $building = Building::create(array(
                    'building_name' => $request->input('building_name'),
                    'total_rooms' => $request->input('total_rooms'),
                    'occupancy' => $request->input('occupancy'),
                ));

                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'add building',
                    'data' => $building,
                ));
            }

            $contacts = [];
            if ($request->has('name')) {
                foreach ($request->input('name') as $index => $name) {
                    // Log::info($name);
                    if (strlen($name) && strlen($request->input('phone')[$index])) {
                        $contacts[] = [
                            'building_id' => $building->id,
                            'name' => $name,
                            'phone' => $request->input('phone')[$index],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                }
            }
            if (count($contacts)) {
                BuildingContact::insert($contacts);
                LogReport::create(array(
                    'user_id' => auth()->user()->id,
                    'type' => 'edit building contact',
                    'data' => $building,
                ));
            }

            $request->session()->flash('form-save', true);

            return response()->json([
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Saved',
            ], 200);
        }

        // return response()->json('saved', 200);
    }

    public function edit(Request $request, $id)
    {
        $data_bundle = [];
        $data_bundle['buildings'] = Building::findOrFail($id);
        return view('admin.building.edit', compact('data_bundle'));
    }

    public function addContact(Request $request)
    {
        $validationRule = array(
            'building_id' => 'required|exists:buildings,id',
            'name' => 'required',
            'phone' => 'required',
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

            $contact = BuildingContact::create(array(
                'building_id' => $request->input('building_id'),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
            ));

            LogReport::create(array(
                'user_id' => auth()->user()->id,
                'type' => 'add building contact',
                'data' => $contact,
            ));

            $request->session()->flash('form-save', true);

            return response()->json([
                'code' => 200,
                'status' => 'OK',
                'message' => 'Data Saved',
            ], 200);
        }
    }

    public function delete(Request $request, $id)
    {
        // delete
    }

    public function view(Request $request, $id)
    {
        $data_bundle = [];
        $data_bundle['buildings'] = Building::findOrFail($id);
        return view('admin.building.view', compact('data_bundle'));
    }

    public function deleteContact(Request $request, $id)
    {
        BuildingContact::where('id', $id)->delete();
        LogReport::create(array(
            'user_id' => auth()->user()->id,
            'type' => 'delete building contact',
            'data' => $id,
        ));

        return redirect()->back()->with('item-delete', true);
    }
}
