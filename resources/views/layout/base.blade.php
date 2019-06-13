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
            @yield('content')
    </div>        
</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')
</html>