<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    public function index(Request $request){
        return view('admin.building.index');
    }

    public function create(Request $request){
        return view('admin.building.create');
    }

    public function save(Request $request, $id=false){
        //save
    }

    public function edit(Request $request, $id) {
        return view('admin.building.edit');
    }

    public function delete(Request $request, $id){
        // delete
    }

    public function view(Request $request, $id){
        return view('admin.building.view');
    }
}
