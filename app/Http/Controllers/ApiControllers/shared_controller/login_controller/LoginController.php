<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\login_controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_phone1' => 'required',
            'password' => 'required'
        ], [
            'user_phone1.required' => 'الرجاء إرسال رقم الهاتف',
            'password.required' => 'الرجاء إرسال كلمة المرور',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $credentials = $validator->validated();

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('api-token')->plainTextToken;
            return response([
                'status' => true,
                'message' => 'تم تسجيل الدخول بنجاح',
                'user' => auth()->user(),
                'token' => $token,
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'الرجاء التأكد من البيانات المدخلة'
            ], 401);
        }
    }
}
