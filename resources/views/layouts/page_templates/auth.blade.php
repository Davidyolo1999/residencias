<div class="wrapper">
    <x-period-modal />
    @include('layouts.navbars.sidebar')
    <div class="main-panel">
        @include('layouts.navbars.navs.auth')
        @yield('content')
        @include('layouts.footers.auth')
    </div>
</div>
