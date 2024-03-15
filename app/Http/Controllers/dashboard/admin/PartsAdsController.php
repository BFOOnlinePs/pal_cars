<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\PartExpoModel;
use Illuminate\Http\Request;

class PartsAdsController extends Controller
{
    //
    public function index(){
        $data = PartExpoModel::orderBy('created_at', 'desc')->with('car','user')->get();
        return view('dashboard.admin.parts_ads.index',['data'=>$data]);
    }

    public function delete(Request $request){
        // $reuest->id;
        $data = PartExpoModel::where('id',$request->id)->first();

        if ($data->delete()){
            $data = $data = PartExpoModel::orderBy('created_at', 'desc')->with('car','user')->get();
            return response()->json([
                'success'=>'true',
                'message'=>'تم الحذف  بنجاح',
                'view'=>view('dashboard.admin.parts_ads.ajax.part_expo_table',['data'=>$data])->render(),
            ]);
        }
        else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم الحذف'
            ]);
        }
    }
}
