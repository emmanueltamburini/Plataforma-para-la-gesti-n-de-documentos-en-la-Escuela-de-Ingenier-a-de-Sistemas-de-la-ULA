<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tesis</title>
    <link rel="stylesheet" href="/css/app.css">
    <style type="text/css">    @yield('style')  </style>
</head>
<body>

	<div class="container-fluid">
		<div class="row">
		    <div class="col-8 text-center mx-auto">
		        <h2 class="bg-primary">Bienvenido estudiante {{ $name }} dueño de la C.I: {{ $ID }}, Este es un correo para verificar el trámite <strong>{{ $request_type }}</strong> !</h2>
		        <p>Por favor confirma tu correo electrónico.</p>
		        <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>

		        <a href="{{ url(\Config::get('constants.url').'/register/verify/' . $id_petition ."/". $confirmation_code) }}" class="btn btn-primary" target="_blank">
		            Clic para confirmar tu email
		        </a>
		        <br><br>
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
		    <div>
		</div>
	</div>
	<script src="/js/app.js"></script>
</body>
</html>


