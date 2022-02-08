@extends('layouts.main', ['activePage' => '403', 'title' => __(''), 'titlePage' => 'Error 403'])

@section('content')
    <div class="content">
        <h2 class="text-center">403 {{ $exception->getMessage() }}</h2>
    </div>
@endsection
