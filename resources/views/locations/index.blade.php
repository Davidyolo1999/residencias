@extends('layouts.main', ['activePage' => 'locations', 'title' => __(''), 'titlePage' => 'Ubicaciones'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($alert = session('alert'))
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="alert alert-{{ $alert['type'] }}" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ $alert['message'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header card-header-success ">
                            <h4 class="card-title text-white"> <b>Ubicaciones</b> </h4>
                            <p class="card-category text-white"><b>Lista de Ubicaciones</b> </p>
                        </div>
                        <div class="card-body">
                            <div class="text-right ">
                                <a href="{{ route('locations.create') }}" class="btn btn-warning btn-sm btn-round"> <i
                                        class="material-icons">add_circle</i> Nuevo </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead">
                                        <tr class="">
                                            <th class="text-center  table-  text-dark"># </th>
                                            <th class="text-center  table- text-dark">Nombre </th>
                                            <th class="text-center  table- text-dark">Pertenece a </th>
                                            <th class="text-right   table-  text-dark">Acciones </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($locations as $location)
                                            <tr>
                                                <td class=" text-center"> {{ $location->id }}</td>
                                                <td class=" text-center">{{ $location->name }} </td>
                                                <td class=" text-center">
                                                    {{ $location->parentLocation->name ?? 'No pertenece a otra ubicación' }}</b>
                                                </td>
                                                <td class="text-nowrap text-right td-actions">
                                                    <a href="{{ route('locations.edit', $location) }}"
                                                        class="btn btn-sm btn-info btn-success" title="Editar">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <form action="{{ route('locations.destroy', $location) }}"
                                                        method="POST" class="d-inline-block delete-location-form">
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
