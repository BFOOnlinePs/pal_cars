<?php

namespace App\Http\Controllers\dashboard\insurance_company;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CompanyInformationController extends Controller
{
    //
    public function index($id){
        $data = User::where('id',$id)->first();
        return view('dashboard.insurance_company.company_information.index',['data'=>$data]);
    }

    public function update(Request $request){
        $data = User::find($request->user_id);

        // if (!$data) {
        //     return redirect()->back()->withInput()->withErrors(['User not found']);
        // }

        if ($data->user_phone1 != $request->user_phone1 && User::where('user_phone1', $request->user_phone1)->exists()) {
            return redirect()->back()->withInput()->withErrors(['رقم الهاتف موجود مسبقاً']);
        }

        $data->user_address = $request->user_address;
        $data->user_phone1 = $request->user_phone1;
        $data->email = $request->email;

        if ($request->user_phone2 != '') {
            $data->user_phone2 = $request->user_phone2;
        }

        if ($request->password != '') {
            $data->password = Hash::make($request->password);
        }

        if ($data->save()) {
            Session::flash('success', 'تم التعديل بنجاح !');
            return redirect()->route('dashboard.insurance_company.company_information.index', ['id' => $data->id]);
        } else {
            return redirect()->back()->withInput()->withErrors(['فشل تعديل البيانات']);
        }
    }

}
