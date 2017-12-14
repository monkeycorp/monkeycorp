<!doctype html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MercadoLibre - API</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div id="app" class="container">
    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>