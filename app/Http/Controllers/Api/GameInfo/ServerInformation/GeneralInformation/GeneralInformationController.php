<?php

namespace App\Http\Controllers\GameInfo\ServerInfo\GeneralInfo;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\GeneralInfo\GeneralInformation;

class GeneralInformationController extends Controller
{
    public function index()
    {
        $data = GeneralInformation::with([
            'FeaturesInformation.FeaturesEnable',
            'FeaturesInformation.FeaturesDisable'
        ])->first(); 

        return response()->json($data);
    }
}
