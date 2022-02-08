@extends('layouts.main', ['activePage' => 'admins', 'title' => __(''), 'titlePage' => 'Administradores'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
        <div class="alert alert-{{ $alert['type'] }}" role="alert">
            {{ $alert['message'] }}
        </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success ">
                <h4 class="card-title text-white"> <b>Administradores</b> </h4>
                <p class="card-category text-white"><b>Lista de Administradores</b> </p>
            </div>
            <div class="card-body">
                <div class="text-right ">
                    <a href="{{ route('admins.create') }}" class="btn btn-warning btn-sm"> <i class="material-icons">person_add</i>  Añadir administrador</a>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead">
                            <tr class="">
                                <th class="text-center  table-  text-dark"><b>#</b> </th>
                                <th class="text-center  table- text-dark"><b>E-mail</b> </th>
                                <th class="text-center  table- text-dark"><b>Nombre(s)</b> </th>
                                <th class="text-center  table-  text-dark"><b>Apellidos</b> </th>
                                <th class="text-right   table-  text-dark"><b>Acciones</b> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr>
                                    <td class=" text-center"><b> {{ $admin->id }}</b></td>
                                    <td class=" text-center"><b>{{ $admin->email }}</b> </td>
                                    <td class=" text-center"><b>{{ $admin->admin->first_name }}</b> </td>
                                    <td class="  text-center"><b>{{ $admin->admin->last_name }}</b> </td>
                                    <td class="text-nowrap text-right ">
                                        <a href="" class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="material-icons">details</i>
                                        </a>
                                        <a href="{{ route('admins.edit', $admin) }}" class="btn btn-sm btn-info" title="Editar" >
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form
                                            action="{{ route('admins.destroy', $admin) }}"
                                            method="POST"
                                            class="d-inline-block delete-admin-form"
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
                {{ $admins->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>        
        const deleteAdminForms = document.querySelectorAll('.delete-admin-form');
        
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
