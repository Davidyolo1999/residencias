@extends('layouts.main', ['activePage' => 'locations', 'title' => __(''), 'titlePage' => 'Ubicaciones'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
        <div class="alert alert-{{ $alert['type'] }}" role="alert">
            {{ $alert['message'] }}
        </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success ">
                <h4 class="card-title text-white"> <b>Ubicaciones</b> </h4>
                <p class="card-category text-white"><b>Lista de Ubicaciones</b> </p>
            </div>
            <div class="card-body">
                <div class="text-right ">
                    <a href="{{ route('locations.create') }}" class="btn btn-warning btn-sm"> <i class="material-icons">add_circle</i> Añadir Nuevo </a>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead">
                            <tr class="">
                                <th class="text-center  table-  text-dark"><b>#</b> </th>
                                <th class="text-center  table- text-dark"><b>Nombre</b> </th>
                                <th class="text-center  table- text-dark"><b>Pertenece a</b> </th>
                                <th class="text-right   table-  text-dark"><b>Acciones</b> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($locations as $location)
                                <tr>
                                    <td class=" text-center"><b> {{ $location->id }}</b></td>
                                    <td class=" text-center"><b>{{ $location->name }}</b> </td>
                                    <td class=" text-center"><b> {{ $location->parentLocation->name ?? 'No pertenece a otra ubicación' }}</b></td>
                                    <td class="text-nowrap text-right ">
                                        <a href="{{ route('locations.edit', $location) }}" class="btn btn-sm btn-info" title="Editar" >
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form
                                            action="{{ route('locations.destroy', $location) }}"
                                            method="POST"
                                            class="d-inline-block delete-location-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Sin registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $locations->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>        
        const deleteLocationForms = document.querySelectorAll('.delete-location-form');
        
        deleteLocationForms.forEach(form => form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        }))
    </script>
@endpush