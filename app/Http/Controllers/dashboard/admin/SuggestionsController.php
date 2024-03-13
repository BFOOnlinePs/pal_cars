<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\SuggestionModel;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    //
    public function suggestions(){
        $data = SuggestionModel::get();
        return view('dashboard.admin.suggestions.index',['data'=>$data]);
    }
}
