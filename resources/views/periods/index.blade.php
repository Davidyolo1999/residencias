@extends('layouts.main', ['activePage' => 'periods', 'title' => __(''), 'titlePage' => 'Periodos'])

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
                            <h4 class="card-title text-white"> <b>Periodos</b> </h4>
                            <p class="card-category text-white"><b>Lista de Periodos</b> </p>
                        </div>
                        <div class="card-body">
                            <div class="text-right ">
                                <a href="{{ route('periods.create') }}" 
                                data-toggle-second="tooltip" data-placement="top"
                                title="Aquí puedes crear un nuevo periodo."
                                class="btn btn-warning btn-sm btn-round"> <i
                                        class="material-icons">today</i> Nuevo</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead">
                                        <tr class="">
                                            <th class="text-center text-dark">#</th>
                                            <th class="text-center text-dark">Nombre</th>
                                            <th class="text-center text-dark">Periodo</th>
                                            <th class="text-center  text-dark">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($periods as $period)
                                            <tr>
                                                <td class="text-center"> {{ $period->id }}</td>
                                                <td class="text-center">{{ $period->name }} </td>
                                                <td class="text-center">{{ $period->start->format('M Y') }} -
                                                    {{ $period->end->format('M Y') }}</td>
                                                <td class=" td-actions text-nowrap text-center ">
                                                    <a href="{{ route('periods.edit', $period) }}"
                                                        data-toggle-second="tooltip" data-placement="top"
                                                        title="Aquí puedes editar la información del asesor externo."
                                                        class="btn btn-sm btn-info btn-success" title="Editar">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <form action="{{ route('periods.destroy', $period) }}" method="POST"
                                                        class="d-inline-block delete-period-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-toggle-second="tooltip" data-placement="top"
                                                            title="Aquí puedes eliminar el periodo."
                                                            class="btn btn-sm btn-danger">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-danger">Sin registros.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $periods->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const deleteAdminForms = document.querySelectorAll('.delete-period-form');

        deleteAdminForms.forEach(form => form.addEventListener('submit', function(e) {
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
