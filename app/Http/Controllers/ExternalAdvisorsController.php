<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExternalAdvisorRequest;
use App\Http\Requests\UpdateExternalAdvisorRequest;
use App\Models\ExternalAdvisor;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class ExternalAdvisorsController extends Controller
{
    
    public function index()
    {
        $externaladvisors = ExternalAdvisor::query()
            ->withEmail()
            ->paginate();

        return view('external-advisor.index', [
            'externaladvisors' => $externaladvisors,

        ]);
    }

    public function create()
    {
        return view('external-advisor.create', [
            'states' => Location::with(['locations.locations'])->state()->get(),
        ]);
    }

    public function store(StoreExternalAdvisorRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->userData());

            $user->externalAdvisor()->create($request->externalAdvisorData());

            DB::commit();

        } catch(Throwable $t) {
            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('externalAdvisor.index')->with('alert', [
            'type' => 'success',
            'message' => 'El asesor externo se agrego correctamente',
        ]);
    }

    public function destroy(ExternalAdvisor $externaladvisor)
    {
        User::destroy($externaladvisor->user_id);

        return redirect()->route('externalAdvisor.index')->with('alert', [
            'type' => 'success',
            'message' => 'El asesor externo ha sido eliminado',
        ]);
    }

    public function edit(ExternalAdvisor $externaladvisor)
    {
        return view('external-advisor.edit', [
            'externaladvisor' => $externaladvisor,
            'states' => Location::with(['locations.locations'])->state()->get(),
        ]);
    }

    public function update(UpdateExternalAdvisorRequest $request, ExternalAdvisor $externaladvisor)
    {
          DB::beginTransaction();
        
        try {
            $externaladvisor->update($request->externalAdvisorData());

            $externaladvisor->user->update($request->userData());

            DB::commit();

        } catch(Throwable $t) {

            DB::rollBack();

            return back()->with('alert', [
                'type' => 'danger',
                'message' => 'Ha ocurrido un error, intente más tarde.',
            ]);
        }

        return redirect()->route('externalAdvisor.index')->with('alert', [
            'type' => 'success',
            'message' => 'El asesor externo ha sido actualizado',
        ]);
    }

    public function updatePassword(Request $request, ExternalAdvisor $externaladvisor)
    {
        $request->validate(['password' => 'required|min:6|confirmed']);

        $externaladvisor->user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('externalAdvisor.index')->with('alert',[
            'type' => 'success',
            'message' =>'la contraseña ha sido actualizada',
        ]);
    }

}
