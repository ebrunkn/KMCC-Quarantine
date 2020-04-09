<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(Request $request){
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'Data Saved',
            'notification_count'=>100,
        ], 200);
    }
}
