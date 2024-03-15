<?php

namespace App\Http\Controllers\web_page;

use App\Http\Controllers\Controller;
use App\Models\AccidentsModel;
use App\Models\NotificationsModel;
use App\Models\User;
use Illuminate\Http\Request;

class AccidentsController extends Controller
{
    //
    public function index(){
        // $data = SuggestionModel::get();

        $insurance_companies = User::whereJsonContains('user_role', ['8'])->get();
        return view('web_pages.accidents.add',['insurance_companies'=>$insurance_companies]);
    }

    public function create(Request $request){
        $data = new AccidentsModel();
        $data->user_id = $request->user_id;
        $data->driver_name = $request->driver_name;
        $data->id_number = $request->id_number;
        $data->license_id = $request->license_id;
        $data->Insurance_id = $request->Insurance_id;
        $data->accident_desc = $request->accident_desc;
        $data->accident_location = $request->accident_location;
        $data->Insurance_company_id = $request->Insurance_company_id;
        $data->car_number = $request->car_number;
        // $data-> = $request->;
        if($data->save()){
            $notifications = new NotificationsModel();
            $notifications->rec_id = $data->id;
            $notifications->seen = 0;
            $notifications->type = "accedent";
            $notifications->user_id = $request->Insurance_company_id;
            $notifications->insert_by = $request->user_id;
            if($notifications->save()){
                return redirect()->route('web_pages.cars_ads.create_message')->with(['success' => 'تم إضافة البلاغ بنجاح !']);
            }else {
                return redirect()->back()->withInput();
            }
        }else {
            return redirect()->back()->withInput();
        }
    }
}
