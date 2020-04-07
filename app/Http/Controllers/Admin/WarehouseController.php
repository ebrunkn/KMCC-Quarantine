<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    public function index(Request $request){
        return view('admin.warehouse.index');
    }

    public function create(Request $request){
        return view('admin.warehouse.create');
    }

    public function save(Request $request, $id=false){
        //save
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
