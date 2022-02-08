<div class="sidebar" data-color="orange" data-background-color="" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo" align="center">
        <img src="{{ asset('img/logo2.png') }}" alt="umb" height="95" width="180">
        <br><br>
        <h4><div class="text-warning"><b>Residencias Profesionales</b></div></h4>
  
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                <i class="material-icons"> dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            {{-- PERFIL --}}
            <li class="nav-item">
                <a
                    class="
                        nav-link
                        @if ($profileMenuActive = ($activePage == 'profile' || $activePage == 'company-info' || $activePage == 'project-info' || $activePage == 'residency-process'))
                            active
                        @else
                            collapsed
                        @endif
                    "
                    data-toggle="collapse"
                    href="#profile-menu-item"
                    aria-expanded="{{ $profileMenuActive ? 'true' : 'false' }}"
                >
                    <p>
                        <i class="material-icons">account_circle</i>
                        Perfil<b class="caret"></b>
                    </p>
                </a>

                <div class="collapse show" id="profile-menu-item">
                    <ul class="nav">
                        @can('view-personal-info')
                        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('students.personalInfo') }}">
                                <span class="sidebar-mini">
                                    <i class="material-icons">dashboard</i>
                                </span>
                                <span class="sidebar-normal">Información personal</span>
                            </a>
                        </li>
                        @endcan
                        @can('view-company-info')
                        <li class="nav-item{{ $activePage == 'company-info' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('students.companyInfo')}}">
                                <i class="material-icons">dashboard</i>
                                <span class="sidebar-mini">
                                </span>
                                <span class="sidebar-normal">Información de la empresa</span>
                            </a>
                        </li>
                        @endcan
                        @can('view-project-info')
                        <li class="nav-item{{ $activePage == 'project-info' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('students.projectInfo')}}">
                                <i class="material-icons">dashboard</i>
                                <span class="sidebar-mini">
                                </span>
                                <span class="sidebar-normal">Información del proyecto</span>
                            </a>
                        </li>
                        @endcan
                        @can('view-residency-info')
                        <li class="nav-item{{ $activePage == 'residency-process' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('students.residencyProcess') }}">
                                <i class="material-icons">dashboard</i>
                                <span class="sidebar-mini">
                                </span>
                                <span class="sidebar-normal">Proceso de residencia</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>


            @can('index', App\Models\Admin::class)
            <li class="nav-item{{ $activePage == 'admins' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admins.index') }}">
                <i class="material-icons">manage_accounts</i>
                    <p> <b>Administradores</b> </p>
                </a>
            </li>
            @endcan

            @can('index', App\Models\Student::class)
            <li class="nav-item{{ $activePage == 'students' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('students.index') }}">
                <i class="material-icons">people</i>
                    <p><b>Estudiantes</b> </p>
                </a>
            </li>
            @endcan
            @can('index', App\Models\Teacher::class)
            <li class="nav-item{{ $activePage == 'teachers' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('teachers.index') }}">
                <i class="material-icons">people</i>
                    <p><b>Profesores</b> </p>
                </a>
            </li>
            @endcan
            @can('index', App\Models\ExternalAdvisor::class)
            <li class="nav-item{{ $activePage == 'external-advisor' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('externalAdvisor.index') }}">
                <i class="material-icons">people</i>
                    <p><b>Asesores Externos</b> </p>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>
