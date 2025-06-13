<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesInformation;

class FeaturesInformationController extends Controller
{
    public function index()
    {
        $data = FeaturesInformation::with(['FeaturesEnable', 'FeaturesDisable'])->get();

        return response()->json($data);
    }
}
