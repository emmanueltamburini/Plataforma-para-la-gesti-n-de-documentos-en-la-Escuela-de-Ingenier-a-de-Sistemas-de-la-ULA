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
		        <h2 class="bg-primary">Peticiones pendientes por procesar del estudiante {{ $petitions->first()->user()->get()[0]->name }}</h2>

                @if($petitions)
                    <table class="table  table-hover table-primary ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="active">Solicitud</th>
                                <th scope="col" class="active">Tipo</th>
                                <th scope="col" class="active">Estado</th>
                                <th scope="col" class="active">Fecha</th>
                                <th scope="col" class="active">Estado solicitud</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($petitions as $petition)
                            	@if($petition['status'] != 6 and $petition['status'] != 1)
	                                <tr>
	                                    <td>{{ $petition['ID_user']."-".$petition['id'] }}</td>
	                                    <td>{{ $petition->request_type()->get()[0]->info }}</td>
	                                    <td>{{ $petition->status()->get()[0]->info }}</td>
	                                    <td> {{  DATE_FORMAT($petition['created_at'], "d-m-Y")  }}</td>
	                                    <td>{{ $petition['info'] }}</td>
	                                </tr>
	                            @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif

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


