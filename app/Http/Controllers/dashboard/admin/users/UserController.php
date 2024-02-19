<?php

namespace App\Http\Controllers\dashboard\admin\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLevels;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(){
        return view('dashboard.admin.users.index');
    }

    public function add_form(){
        $user_role = UserRole::get();
        return view('dashboard.admin.users.add',['user_role'=>$user_role]);
    }

    public function create(Request $request){
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->user_phone1 = $request->user_phone1;
        $data->user_phone2 = $request->user_phone2;
        $data->user_role = json_encode($request->role_level);

        $data->user_status = 1;
        // if(auth()->user()->user_role == 1){
        //     $data->follow_by = json_encode($request->follow_by);
        // }
        // if(auth()->user()->user_role == 2){
        //     $data->follow_by = '["'.auth()->user()->id.'"]';
        // }
        $data->user_reg_date = Carbon::now();
        if ($request->hasFile('user_photo')) {
            $file = $request->file('user_photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('user_photo', $filename, 'public');
            $data->user_photo = $filename;
        }
        $data->user_notes = $request->user_notes;
        $data->user_website = $request->user_website;
        $data->user_address = $request->user_address;
        $data->user_category = $request->user_category;
        $data->user_account_number = $request->user_account_number;
        $data->user_bank_name = $request->user_bank_name;
        $data->user_bank_address = $request->user_bank_address;
        $data->user_swift_code = $request->user_swift_code;
        $data->user_iban_number = $request->user_iban_number;
        if ($data->save()){
            $user_role = UserRole::get();
            $user_levels = UserLevels::findOrNew($data->id);
            $user_levels->user_id = $data->id;
            $user_levels->role_id = json_encode($request->role_level);
            if($user_levels->save()){
                // return redirect()->route('users.supplier.index')->with(['success'=>'تم اضافة البيانات بنجاح','tab_id'=>1]);
                return redirect()->route('dashboard.admin.users.add')->with(['success'=>'تم اضافة البيانات بنجاح','tab_id'=>1,'user_role'=>$user_role]);
            }
        }
        else{
            return redirect()->back()->withInput();
        }
    }
}
