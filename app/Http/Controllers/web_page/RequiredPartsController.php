<?php

namespace App\Http\Controllers\web_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequiredPartsController extends Controller
{
    //
    public function index(){
        // $data = PartExpoModel::orderBy('created_at', 'desc')->with('car','user')->get();
        // $cars = CarsType::get();
        // return $data;
        return view('web_pages.required_parts.index');
    }
}
