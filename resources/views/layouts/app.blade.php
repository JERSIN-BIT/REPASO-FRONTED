<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Frontend</title>
    @include('includes.dependencias')
</head>
<body>
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')
    @include('includes.dependenciasbody')
</body>
</html>