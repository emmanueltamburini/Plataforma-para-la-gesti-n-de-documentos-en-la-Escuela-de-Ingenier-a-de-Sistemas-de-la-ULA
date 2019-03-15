<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tesis</title>
    <link rel="stylesheet" href="/css/app.css">
    <style type="text/css">    @yield('style')  </style>
    <link rel="icon" href="/favicon.png" type="image/png" sizes="32x32">
</head>
<body>
    {{--************************************Barra de navegación*****************************************************--}}
    <div class=" container-fluid bg-primary">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-sm bg-primary navbar-primary ">
                    <a href="/" class="navbar-brand btn btn-primary">Inicio</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#uno">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar navbar-collapse justify-content-center">
                        <img src="/img/ula.png" alt="Sistema" style="width: 200px;">
                    </div>
                    <div>
                        <ul class="navbar-nav justify-content-end">
                            <li class="nav-item btn btn-primary"><a href="/Seguimiento" class="text-light  nav-link btn-link ">Seguimiento</a></li>
                            <li class="nav-item btn btn-primary"><a href="/Solicitud" class="text-light nav-link btn-link">Solicitud</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <hr>

    {{--***************************************Imensajes de verificación**********************************************************--}}
    @if(session('status-check'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status-check') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('status-danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('status-danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{--***************************************Imagen ULA***********************************************************--}}
    <div class="container-fluid">
        <img src="/img/ingenieria.png" alt="ULA" class="img-fluid mx-auto d-block w-50">
    </div>

    <hr>
    {{--*******************************************Contenido********************************************************--}}
    @yield('content')
    <hr>
    {{--*********************************************footer*********************************************************--}}
    <!-- Footer -->
    <!-- Footer -->
    <footer class="bg-primary">


        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2018 Copyright:
            <a href="http://www.ula.ve/" class="text-light"> ula.ve</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <script src="/js/app.js"></script>
    @yield('scripts')
</body>
</html>