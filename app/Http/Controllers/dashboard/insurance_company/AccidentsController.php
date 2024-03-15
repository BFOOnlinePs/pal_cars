<?php

namespace App\Http\Controllers\dashboard\insurance_company;

use App\Http\Controllers\Controller;
use App\Models\AccidentsModel;
use App\Models\NotificationsModel;
use Illuminate\Http\Request;

class AccidentsController extends Controller
{
    //
    public function index($id){
        $data = AccidentsModel::orderBy('created_at', 'desc')->with('insurance_company')->where('Insurance_company_id',$id)->get();
        return view('dashboard.insurance_company.accidents.index',['data'=>$data]);
    }

    public function details($id){
        $data =  AccidentsModel::where('id',$id)->with('insurance_company','visitor')->first();
        return view('dashboard.insurance_company.accidents.details',['data'=>$data]);
    }

    public function details_notification($id,$notification_id){
        $notification = NotificationsModel::where('id',$notification_id)->first();
        $notification->seen = 1;
        if($notification->save()){
            $data =  AccidentsModel::where('id',$id)->with('insurance_company','visitor')->first();
            return view('dashboard.insurance_company.accidents.details',['data'=>$data]);
        }

    }
}
