<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateConfigurationRequest;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    
    public function unitInfo()
    {
        $configuration = Configuration::firstOrfail();
        return view('configurations.unit-info', [
            'configuration' => $configuration,
        ]);
    }

    public function updateUnitInfo(UpdateConfigurationRequest $request)
    {
        $configuration = Configuration::firstOrfail();

        $configuration->update($request->validated());

        return redirect()->route('configurations.unitInfo')->with('alert', [
            'type' => 'success',
            'message' => 'La Configuración general ha sido actualizada',
        ]);
    }
}
