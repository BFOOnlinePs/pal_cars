<?php

namespace App\Http\Controllers\ApiControllers\shared_controller\shared_controller;

use App\Http\Controllers\Controller;
use App\Models\SystemSettingsModel;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    public function getTermsOfUse(){
        $terms_of_use = SystemSettingsModel::pluck('terms_of_use')->first();

        return response()->json([
            'status' => true,
            'terms_of_use' => $terms_of_use
        ]);
    }
}
