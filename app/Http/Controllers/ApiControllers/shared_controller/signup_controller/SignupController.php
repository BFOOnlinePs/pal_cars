<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\signup_controller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required', // confirmed in front end
            'phone1' => 'required|unique:users,user_phone1',
            'city_id' => 'required',
            'address' => 'required',
            'role_id' => 'required|exists:user_role,id',

        ], [
            'name.required' => 'الرجاء إرسال الإسم',
            'password.required' => 'الرجاء إرسال كلمة المرور',
            'phone1.unique' => 'رقم المحمول موجود بالفعل',
            'phone1.required' => 'الرجاء إرسال رقم المحمول',
            'city_id.required' => 'الرجاء إرسال المدينة',
            'city_id.exists' => 'رقم المدينة غير موجود',
            'address.required' => 'الرجاء إرسال العنوان',
            'role_id.required' => 'الرجاء إرسال الدور',
            'role_id.exists' => 'رقم الدور غير موجود',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $role_id = $request->input('role_id');

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'user_phone1' => $request->input('phone1'),
            'user_phone2' => $request->input('phone2'),
            'user_city' => $request->input('city_id'),
            'user_address' => $request->input('address'),
            'user_role' =>  "[\"$role_id\"]",
            'user_status' => 1, // active
        ]);

        // $user = new User();
        // $user->name = $request->input('name');

        $token = $user->createToken('api-token')->plainTextToken;

        // Save the token in the remember_token column
        // $user->update(['remember_token' => $token]);

        return response([
            'status' => true,
            'message' => 'تم إنشاء الحساب بنجاح',
            'user' => $user,
            'token' => $token,
        ], 200);
    }
}
