@extends('layouts.main', ['activePage' => 'admins', 'title' => __(''), 'titlePage' => 'Administradores'])

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
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title text-white"> <b>Administradores</b> </h4>
                        <p class="card-category text-white"><b>Lista de Administradores</b> </p>
                    </div>
                    <form class="col-md-6">                        
                        <div class="form-group text-center text-dark has-white search col-md-12">
                            <label for="period_id" class="text-white">
                                Buscar:
                            </label>
                            <input type="text" class="form-control" autofocus name="search" value="{{request('search')}}">
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="text-right ">
                    <a href="{{ route('admins.create') }}" class="btn btn-warning btn-sm btn-round"> <i class="material-icons">person_add</i>  Nuevo</a>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead">
                            <tr class="">
                                <th class="text-center text-dark"># </th>
                                <th class="text-center text-dark">E-mail </th>
                                <th class="text-center text-dark">Nombre </th>
                                <th class="text-center text-dark">Apellidos </th>
                                <th class="text-center  text-dark">Acciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr>
                                    <td class="text-center"> {{ $admin->id }}</td>
                                    <td class="text-center">{{ $admin->email }} </td>
                                    <td class="text-center">{{ $admin->admin->first_name }} </td>
                                    <td class="text-center">{{ $admin->admin->last_name }} </td>
                                    <td class=" td-actions text-nowrap text-center ">
                                        <a href="" class="btn btn-sm btn-info" title="Ver detalles">
                                            <i class="material-icons">details</i>
                                        </a>
                                        <a href="{{ route('admins.edit', $admin) }}" class="btn btn-sm btn-info btn-success" title="Editar" >
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
