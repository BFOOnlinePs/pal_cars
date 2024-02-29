<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\logout_controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function userLogout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'تم تسجيل الخروج بنجاح'
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ أثناء تسجيل الخروج',
                'e_message' => $e->getMessage()
            ], 500);
        }
    }
}
