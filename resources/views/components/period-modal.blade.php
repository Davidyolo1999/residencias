@if (!$existPeriod && Route::currentRouteName() !== 'periods.create' && Route::currentRouteName() !== 'periods.edit' &&  Auth::user()->isAdmin() && Auth::user()->tutorial_complete)
<div id="periods-modal-alert" style="
position: fixed;
display: flex;
top: 0; 
left: 0; 
width: 100vw; 
height: 100vh; 
background: rgba(0,0,0, .6);
z-index: 9999999999999999999999999999999;
justify-content: flex-center;
">
    <div class="col-md-6 m-auto col-sm-6 col-12 animate__animated animate__slideInRight text-center" style="
margin-top: auto;
background: white; 
padding: 30px; 
overflow-y: auto;        
">
        <h3>
            No hay un periodo registrado para estas fechas por favor cargue uno
        </h3>
        <div class="row align-items-center mt-5">
            <div class="col-md-6">
                <button id="cancel-alert" class="btn btn-danger">
                    Cargar luego
                </button>
            </div>
            <div class="col-md-6">
                <a href="{{route('periods.create')}}" class="btn btn-primary">
                    Ir a cargar periodo
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {            
            $('#cancel-alert').click((e) => {
                $('#periods-modal-alert').hide();
            })
        })        
    </script>
@endpush