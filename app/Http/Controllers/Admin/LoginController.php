<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
	{
		return view('admin.auth.login');
	}

	public function loginProcess(Request $request)
	{
		$validationRule = array(
			'email' => 'required|email',
			'password' => 'required'
		);

		$validation = Validator::make($request->input(), $validationRule);

		if ($validation->fails()) {
			// dd($validation);
			return redirect()->back()->withErrors($validation);
		} else {
			if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
				// $user = Auth::user();
				return redirect('/');
			} else {
				return redirect()->back()->withErrors(['Login failed']);
			}
		}
	}

	public function logout() {
		
		Auth::logout();
		return redirect(url('login'));
		
	}
}
