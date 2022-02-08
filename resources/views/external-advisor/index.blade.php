@extends('layouts.main', ['activePage' => 'external-advisor', 'title' => __(''), 'titlePage' => 'Asesores Externos'])

@section('content')
    <div class="content">
        @if($alert = session('alert'))
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
                {{ $alert['message'] }}
            </div>
        @endif

        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title text-white"><b>Asesores Externos</b> </h4>
                <p class="cart-category text-white"><b>Lista de Asesores Externos</b> </p>
            </div>

            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('externalAdvisor.create') }}" class="btn btn-sm  btn-warning"><i class="material-icons">person_add</i> Añadir Asesor Externo</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary text-center">
                            <tr class="text-dark">
                                <th><b> # </b></th>
                                <th><b> E-mail </b></th>
                                <th><b> Nombres </b></th>
                                <th><b> Apellido Paterno </b></th>
                                <th><b> Apellido Materno </b></th>
                                <th><b> Sexo </b></th>
                                <th><b> CURP </b></th>
                                <th><b> Acciones </b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($externaladvisors as $externaladvisor)
                                <tr>
                                    <td><b>{{ $externaladvisor->user_id }}</b></td>
                                    <td><b>{{ $externaladvisor->email }}</b></td>
                                    <td><b>{{ $externaladvisor->first_name }}</b></td>
                                    <td><b>{{ $externaladvisor->fathers_last_name }}</b></td>
                                    <td><b>{{ $externaladvisor->mothers_last_name }}</b></td>
                                    <td><b>{{ $externaladvisor->sex_text }}</b></td>
                                    <td><b>{{ $externaladvisor->curp }}</b></td>
                                    <td>
                                        <a href="{{ route('externalAdvisor.edit', $externaladvisor) }}" class="btn btn-sm btn-info" title="Editar" >
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