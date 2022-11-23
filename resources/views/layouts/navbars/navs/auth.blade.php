<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-warning text-dark navbar-transparent navbar-absolute fixed-top">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#">{{ $titlePage }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
        <form class="navbar-form">
        
        </form>
            <ul class="navbar-nav ">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification">{{ $corrections->count() }}</span>
                        <p class="d-lg-none d-md-block">
                            {{ __('Acciones') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($corrections as $correction)
                            <form action="{{ route('corrections.markAsSolved', $correction) }}" method="POST"
                                class="d-none">
                                @csrf
                                <input type="hidden" name="document_type"
                                    value="{{ $correction->correctionable_type }}">
                            </form>
                            <a class="dropdown-item" href="#"
                                onclick="$(this).prev().submit(); return false;">{{ $correction->content }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Perfil') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        @if (auth()->user()->teacher || auth()->user()->externalAdvisor)
                            <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Mi perfil') }}</a>
                        @endif                                                
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Cerrar Sesión') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
