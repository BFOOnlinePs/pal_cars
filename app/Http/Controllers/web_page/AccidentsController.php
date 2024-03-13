<?php

namespace App\Http\Controllers\web_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccidentsController extends Controller
{
    //
    public function index(){
        // $data = SuggestionModel::get();
        return view('web_pages.accidents.add');
    }
}
