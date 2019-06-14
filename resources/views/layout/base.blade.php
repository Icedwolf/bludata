<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />

    @yield('styles')

</head>
<body>
    <div class="container">
        <div class="col-md">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Bludata</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cliente.index') }}">Home<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'cliente.cadastro' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route("cliente.create") }}">Cadastro Clientes</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Ação</a>
                        <a class="dropdown-item" href="#">Outra ação</a>
                    </li> --}}
                </div>
            </nav>
        </div>
    </div>
    
    <div class="container">
        @yield('content')
    </div>        
</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')
</html>