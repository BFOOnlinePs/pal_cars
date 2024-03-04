<?php

namespace App\Http\Controllers\dashboard\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSettingsModel;

class TermsOfUseController extends Controller
{
    //
    public function index(){
        $data = SystemSettingsModel::first();
        return view('dashboard.admin.settings.terms_of_use.index',['data'=>$data]);
    }

    public function update(Request $request){
        $data = SystemSettingsModel::first();

        ///these for store it without html tags and with <br>
        $contentWithoutListItems = preg_replace('/<li[^>]*>(.*?)<\/li>/', '$1<br>', $request->terms_of_use);
        $contentWithBr = str_replace("\n", "<br>", $contentWithoutListItems);
        $contentWithoutTags = strip_tags($contentWithBr, '<br>');
        /////////////////////////////

        $data->terms_of_use = $contentWithoutTags;

        if ($data->save()){
            return response()->json([
                'success'=>'true',
                'message'=>'تم تعديل البيانات بنجاح'
            ]);
        }
        else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم تعديل البيانات'
            ]);
        }
    }
}
