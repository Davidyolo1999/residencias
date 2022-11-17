@extends('layouts.main', ['activePage' => 'periods', 'title' => __(''), 'titlePage' => 'Editar Periodo'])

@section('content')
    <div class="content">
        @if ($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Editar Periodo</b> </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('periods.update', $period) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- FIRST NAME --}}
                    <x-inputs.text-field-row 
                        name="name" 
                        label="Nombre del periodo:" 
                        placeholder="Ingresé el nombre"
                        :default-value="$period->name"
                    />                    
                    
                    {{-- START --}}
                    <x-inputs.text-field-row 
                        name="start" 
                        type="date" 
                        label="Inicia:"
                        :default-value="$period->start->format('Y-m-d')"
                    />

                    {{-- END --}}
                    <x-inputs.text-field-row 
                        name="end" 
                        type="date" 
                        label="Finaliza:"
                        :default-value="$period->end->format('Y-m-d')"
                    />

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
