<?php

namespace App\Http\Controllers\dashboard\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        return view('dashboard.admin.settings.index');
    }
}
