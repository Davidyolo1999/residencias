@extends('layouts.main', ['activePage' => 'periods', 'title' => __(''), 'titlePage' => 'Periodos'])

@section('content')
    <div class="content">
        @if ($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Añadir Periodo</b> </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('periods.store') }}" method="POST">
                    @csrf

                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row name="name" label="Nombre del periodo:" placeholder="Ingresé el nombre" />

                    {{-- START --}}
                    <x-inputs.text-field-row name="start" type="date" label="Inicia:" />

                    {{-- END --}}
                    <x-inputs.text-field-row name="end" type="date" label="Finaliza:" />                                
                        <div class="float-right">
                            <a href="{{ route('periods.index') }}" class="btn btn-sm btn-warning mr-3">
                                <i class="material-icons">cancel</i>
                                <b> Cancelar</b> 
                            </a>
                            <button class="btn  btn-success btn-sm">
                                <i class="material-icons">save</i>
                                <b> Guardar</b>
                            </button>
                        </div>

                </form>
            </div>
        </div>
    </div>
@endsection
