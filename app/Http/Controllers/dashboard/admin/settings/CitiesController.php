<?php

namespace App\Http\Controllers\dashboard\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;

class CitiesController extends Controller
{
    //
    public function index(){
        $data = Cities::get();
        return view('dashboard.admin.settings.cities.index',['data'=>$data]);
    }

    public function get(){
        $data = Cities::get();
        return response()->json([
            'view'=>view('dashboard.admin.settings.cities.ajax.citiesTable',['data'=>$data])->render(),
        ]);
    }



    public function create(Request $request){

        // $city = $request->city;
        $city = new Cities();
        $city->city_name = $request->city;
        if($city->save()){
            $data = Cities::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('dashboard.admin.settings.cities.ajax.citiesTable',['data'=>$data])->render(),
            ]);
        }
    }

    public function update(Request $request){
        $data = Cities::where('id',$request->edit_city_id)->first();
        $data->city_name = $request->edit_city_name;
        if($data->save()){
            $data = Cities::get();
            return response()->json([
                'success'=>'true',
                'view'=>view('dashboard.admin.settings.cities.ajax.citiesTable',['data'=>$data])->render(),
            ]);
        }
    }
}
