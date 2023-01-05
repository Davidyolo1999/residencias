@extends('layouts.main', ['activePage' => 'charts', 'title' => __(''), 'titlePage' => 'Gráficos'])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card p-3 letter">
              <h5>
                <b>
                Clasificación por Género de los Estudiantes que Presentarón su Residencia Profesional:
              </b>
              </h5>
              <form>
                <div class="row mb-4 align-items-center">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="" class="letter text-dark">Carrera</label>
                      <select name="career_id" class="form-control">
                        <option value="" selected>Seleccione una opción</option>
                        @foreach ($careers as $career)
                            <option @if (request('career_id') == $career->id) selected @endif value="{{$career->id}}">{{$career->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group has-warning">
                      <label for="" class="letter text-dark">Desde</label>
                      <input type="date" value="{{request('start')}}" name="start" class="form-control ">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group has-warning">
                      <label for="" class="letter text-dark">Hasta</label>
                      <input type="date" value="{{request('end')}}" name="end" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-warning">
                      Enviar
                    </button>
                  </div>
                </div>
              </form>
              @if ($students['hombres'] > 0 || $students['mujeres'] > 0)
              <div id="students-chart" style="height: 200px;"></div>
              @else
              <h3 class="text-danger text-center">
                No hay estudiantes.
              </h3>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
         var options = {
          series: [@json($students['hombres']), @json($students['mujeres'])],
          chart: {
            type: 'donut',
          },
          labels: ['hombres', 'mujeres'],
          responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#students-chart"), options);
        chart.render();
    </script>        
@endpush
