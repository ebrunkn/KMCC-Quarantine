<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Requirement;

class NotificationController extends Controller
{
    public function index(Request $request){

        $total_unread = Requirement::unread()->count();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'notification_count'=>$total_unread,
        ], 200);
    }
}
