<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\AccidentsModel;
use Illuminate\Http\Request;

class AccidentAnnouncementsController extends Controller
{
    //
    public function index(){
        $data = AccidentsModel::orderBy('created_at', 'desc')->with('insurance_company')->get();
        return view('dashboard.admin.accident_announcements.index',['data'=>$data]);
    }

    public function details($id){
        $data =  AccidentsModel::where('id',$id)->with('insurance_company','visitor')->first();
        return view('dashboard.admin.accident_announcements.details',['data'=>$data]);
    }
}
