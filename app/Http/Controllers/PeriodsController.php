<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeriodRequest;
use App\Http\Requests\UpdatePeriodRequest;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodsController extends Controller
{
    private $entityName = 'periodo';


    public function index(Request $request)
    {
        $periods = Period::paginate(10);

        return view('periods.index', [
            'periods' => $periods,
        ]);
    }

    public function create()
    {
        return view('periods.create');
    }

    public function store(StorePeriodRequest $request)
    {
        Period::create($request->validated());

        return redirect()->route('periods.index')->with('alert', [
            'type' => 'success',
            'message' => "El {$this->entityName} se agrego correctamente.",
        ]);
    }

    public function edit(Period $period)
    {
        return view('periods.edit', [
            'period' => $period,
        ]);
    }

    public function update(Period $period, UpdatePeriodRequest $request)
    {
        $period->name = $request->name;
        $period->start = $request->start;
        $period->end = $request->end;

        $period->save();
        
        return redirect()->route('periods.index')->with('alert', [
            'type' => 'success',
            'message' => "El {$this->entityName} ha sido actualizado",
        ]);
    }

    public function destroy(Period $period)
    {
        $period->delete();

        return redirect()->route('periods.index')->with('alert', [
            'type' => 'success',
            'message' => "El {$this->entityName} ha sido eliminado",
        ]);
    }
}
