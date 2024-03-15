<?php

namespace App\Http\Controllers\web_page;

use App\Http\Controllers\Controller;
use App\Models\CarsType;
use App\Models\RequestModel;
use Illuminate\Http\Request;

class RequiredPartsController extends Controller
{
    //
    public function index(){
        // $data = PartExpoModel::orderBy('created_at', 'desc')->with('car','user')->get();
        $data = RequestModel::with('car')->get();
        // $cars = CarsType::get();
        // return $data;
        return view('web_pages.required_parts.index',['data'=>$data]);
    }

    public function choose_car_type(){
        $cars = CarsType::get();
        return view('web_pages.required_parts.choose_car_type',['cars'=>$cars]);
    }

    public function add(){
        return view('web_pages.required_parts.add');
    }

    public function create(){
        
    }
}
