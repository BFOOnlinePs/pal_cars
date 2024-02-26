<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\logout_controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function userLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'تم تسجيل الخروج بنجاح'
        ], 200);
    }
}
