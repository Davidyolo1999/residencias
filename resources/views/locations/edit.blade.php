@extends('layouts.main', ['activePage' => 'locations', 'title' => __(''), 'titlePage' => 'Ubicaciones'])

@section('content')
    <div class="content">
        @if ($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Editar Ubicación</b> </h4>
            </div>

            <div class="card-body">
                <form action="{{ route('locations.update', $location) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- NAME --}}
                    <x-inputs.text-field-row name="name" label="Nombre:" placeholder="Ingresé el Nombre"
                        :default-value="$location->name" />

                    {{-- PARENT ID --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="parent_id" class="d-block">Pertenece a:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-dynamic">
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option value="" selected>Seleccione una Opción
                                    @foreach ($locations as $parentLocation)
                                        <option
                                            value="{{ $parentLocation->id }}"
                                            @if (old('parent_id', $location->parentLocation->id ?? null) == $parentLocation->id) selected @endif
                                        >{{ $parentLocation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('parent_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('locations.index') }}" class="btn  btn-warning mr-3">
                            <i class="material-icons">cancel</i><b> Cancelar</b> </a>
                        <button class="btn  btn-success"><i class="material-icons">save</i><b> Guardar</b></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

  
 