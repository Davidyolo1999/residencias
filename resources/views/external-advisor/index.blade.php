@extends('layouts.main', ['activePage' => 'external-advisor', 'title' => __(''), 'titlePage' => 'Asesores Externos'])

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
            <div class="card-header card-header-success">                
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title text-white"><b>Asesores Externos</b> </h4>
                        <p class="card-category text-white"><b>Lista de Asesores Externos</b> </p>
                    </div>
                    <form class="col-md-6">                        
                        <div class="form-group text-center text-dark search col-md-12">
                            <label for="period_id" class="text-white">
                                Buscar:
                            </label>
                            <input type="text" class="form-control" autofocus name="search" value="{{request('search')}}">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('externalAdvisor.create') }}" class="btn btn-sm btn-warning btn-round"><i class="material-icons">person_add</i> Nuevo</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary text-center">
                            <tr class="text-dark">
                                <th> # </th>
                                <th> E-mail </th>
                                <th> Nombre </th>
                                <th> Apellido Paterno </th>
                                <th> Apellido Materno </th>
                                <th> Sexo </th>
                                <th> CURP </th>
                                <th> Acciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($externaladvisors as $externaladvisor)
                                <tr class="text-dark text-center">
                                    <td>{{ $externaladvisor->user_id }}</td>
                                    <td>{{ $externaladvisor->email }}</td>
                                    <td>{{ $externaladvisor->first_name }}</td>
                                    <td>{{ $externaladvisor->fathers_last_name }}</td>
                                    <td>{{ $externaladvisor->mothers_last_name }}</td>
                                    <td>{{ $externaladvisor->sex_text }}</td>
                                    <td>{{ $externaladvisor->curp }}</td>
                                    <td class="td-actions text-nowrap text-center">
                                        <a href="{{ route('externalAdvisor.edit', $externaladvisor) }}" class="btn btn-sm btn-info btn-success" title="Editar" >
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <form
                                            action="{{ route('externalAdvisor.destroy', $externaladvisor) }}"
                                            method="POST"
                                            class="d-inline-block delete-external-advisor-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $externaladvisors->links() }}
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
@endsection

@push('js')
    <script>        
        const deleteExternalAdvisorForms = document.querySelectorAll('.delete-external-advisor-form');
        
        deleteExternalAdvisorForms.forEach(form => form.addEventListener('submit', function(e) {
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