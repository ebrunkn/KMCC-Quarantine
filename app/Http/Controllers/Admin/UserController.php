<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request){
        return view('admin.user.index');
    }

    public function create(Request $request){
        return view('admin.user.create');
    }

    public function save(Request $request, $id=false){
        //save
    }

    public function edit(Request $request, $id) {
        return view('admin.user.edit');
    }

    public function delete(Request $request, $id){
        // delete
    }

    public function view(Request $request, $id){
        return view('admin.user.view');
    }
}
