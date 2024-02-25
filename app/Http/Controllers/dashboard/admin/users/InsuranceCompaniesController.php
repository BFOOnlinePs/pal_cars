<?php

namespace App\Http\Controllers\dashboard\admin\users;

use App\Http\Controllers\Controller;
use App\Models\CompanyContactPersonModel;
use App\Models\User;
use App\Models\UserLevels;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InsuranceCompaniesController extends Controller
{
    public function index()
    {
        $data = User::whereJsonContains('user_role', ['8'])->get();
        return view('dashboard.admin.users.insurance_companies.index', ['data' => $data]);
    }

    public function add()
    {
        return view('dashboard.admin.users.insurance_companies.add');
    }

    public function create(Request $request)
    {
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->user_phone1 = $request->user_phone1;
        $data->user_phone2 = $request->user_phone2;
        $data->user_role = json_encode(['8']);
        $data->user_status = 1;
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
        if ($data->save()) {
            return redirect()->route('dashboard.users.insurance_companies.index')->with(['success' => 'تم اضافة البيانات بنجاح']);
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        $user_role = UserRole::get();
        return view('dashboard.admin.users.insurance_companies.edit', ['data' => $data,'user_role'=>$user_role]);
    }

    public function update($id, Request $request)
    {
        $data = User::where('id', $id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->password != '') {
            $data->password = Hash::make($request->password);
        }
        $data->user_phone1 = $request->user_phone1;
        $data->user_phone2 = $request->user_phone2;
        if ($request->photo != '') {
            if ($request->hasFile('user_photo')) {
                $file = $request->file('user_photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->storeAs('user_photo', $filename, 'public');
                $data->user_photo = $filename;
            }
        }
        $data->user_notes = $request->user_notes;
        $data->user_website = $request->user_website;
        $data->user_category = $request->user_category;
        $data->user_account_number = $request->user_account_number;
        $data->user_bank_name = $request->user_bank_name;
        $data->user_bank_address = $request->user_bank_address;
        $data->user_swift_code = $request->user_swift_code;
        $data->user_iban_number = $request->user_iban_number;
        if ($data->save()) {
            return redirect()->route('dashboard.users.insurance_companies.edit', ['id', $id])->with(['success' => 'تم اضافة البيانات بنجاح']);
        } else {
            return redirect()->back()->withInput();
        }

    }

    public function details($id)
    {
        $data = User::where('id', $id)->first();
        $company_contact_person = CompanyContactPersonModel::where('company_id', $id)->get();
        foreach ($company_contact_person as $key){
            $key['company'] = User::where('id',$key->company_id)->first();
        }
        return view('dashboard.admin.users.insurance_companies.details', ['data' => $data, 'company_contact_person' => $company_contact_person]);
    }

    public function createContactPerson(Request $request){
        $data = new CompanyContactPersonModel();
        $data->company_id = $request->company_id;
        $data->contact_name = $request->contact_name;
        $data->mobile_number = $request->mobile_number;
        $data->email = $request->email;
        $data->whats_app_number = $request->whats_app_number;
        $data->wechat_number = $request->wechat_number;
        $data->address = $request->address;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->storeAs('user_photo', $filename, 'public');
            $data->photo = $filename;
        }
        if ($data->save()){
            // return redirect()->route('users.supplier.details',['id'=>$request->company_id])->with(['success'=>'تم اضافة جهة التواصل بنجاح','tab_id'=>3]);
            return view('dashboard.admin.users.index')->with(['success'=>'تم اضافة جهة التواصل بنجاح','tab_id'=>3]);
        }
        else{
            // return redirect()->route('users.supplier.details',['id'=>$request->company_id])->with(['fail'=>'لم تتم الاضافة هناك خلل ما','tab_id'=>3]);
            return view('dashboard.admin.users.index')->with(['fail'=>'لم تتم الاضافة هناك خلل ما','tab_id'=>3]);
        }
    }

}
