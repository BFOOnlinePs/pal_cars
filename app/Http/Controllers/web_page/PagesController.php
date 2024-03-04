<?php

namespace App\Http\Controllers\web_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuggestionModel;

class PagesController extends Controller
{
    //
    public function about_us(){
        return view('web_pages.aboutus');
    }

    public function contact_us(){
        return view('web_pages.contactus');
    }

    public function post_suggestion(Request $request){
        $data = new SuggestionModel();

        // $data->id = 0;
        $data->from_name = $request->name;
        $data->tel = $request->contact;
        $data->content = $request->content;

        if ($data->save()){
            return response()->json([
                'success'=>'true',
                'message'=>'تم إرسال الاقتراح بنجاح'
            ]);
        }
        else{
            return response()->json([
                'success'=>'false',
                'message'=>'هناك خلل ما لم يتم إرسال الاقتراح'
            ]);
        }
    }
}
