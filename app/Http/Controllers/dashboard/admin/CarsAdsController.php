<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\CarsAdsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarsAdsController extends Controller
{
    //
    public function index(){
        $data = CarsAdsModel::orderBy('created_at', 'desc')->with('model','carType')->get();
        return view('dashboard.admin.cars_ads.index',['data'=>$data]);
    }

    public function post_adv(Request $request){
        $id = $request->id;
        $data = CarsAdsModel::where('id',$id)->first();
        $data->ads_status = 1;
        $days = $data->ads_days;
        $data->end_date = Carbon::now()->addDays($days);
        if($data->save()){
            $data = CarsAdsModel::orderBy('created_at', 'desc')->with('model','carType')->get();
            return response()->json([
                'success'=>'true',
                'message'=>'تم النشر  بنجاح',
                'view'=>view('dashboard.admin.cars_ads.ajax.cars_ads_table',['data'=>$data])->render(),
            ]);
        }else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم النشر'
            ]);
        }
    }

    public function un_post_adv(Request $request){
        $id = $request->id;
        $data = CarsAdsModel::where('id',$id)->first();
        $data->ads_status = 2;
        // $days = $data->ads_days;
        // $data->end_date = Carbon::now()->addDays($days);
        if($data->save()){
            $data = CarsAdsModel::orderBy('created_at', 'desc')->with('model','carType')->get();
            return response()->json([
                'success'=>'true',
                'message'=>'تم إلغاء النشر  بنجاح',
                'view'=>view('dashboard.admin.cars_ads.ajax.cars_ads_table',['data'=>$data])->render(),
            ]);
        }else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم إلغاء النشر'
            ]);
        }
    }

    public function re_post_adv(Request $request){
        $id = $request->id;
        $data = CarsAdsModel::where('id',$id)->first();
        $data->ads_status = 1;
        $days = $data->ads_days;
        $data->end_date = Carbon::now()->addDays($days);
        if($data->save()){
            $data = CarsAdsModel::orderBy('created_at', 'desc')->with('model','carType')->get();
            return response()->json([
                'success'=>'true',
                'message'=>'تم النشر  بنجاح',
                'view'=>view('dashboard.admin.cars_ads.ajax.cars_ads_table',['data'=>$data])->render(),
            ]);
        }else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم النشر'
            ]);
        }
    }

    public function delete_adv(Request $request){
        $data = CarsAdsModel::where('id',$request->id)->first();

        if($data->delete()){
            $data = CarsAdsModel::orderBy('created_at', 'desc')->with('model','carType')->get();
            return response()->json([
                'success'=>'true',
                'message'=>'تم الحذف  بنجاح',
                'view'=>view('dashboard.admin.cars_ads.ajax.cars_ads_table',['data'=>$data])->render(),
            ]);
        }else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم الحذف'
            ]);
        }
    }
}
