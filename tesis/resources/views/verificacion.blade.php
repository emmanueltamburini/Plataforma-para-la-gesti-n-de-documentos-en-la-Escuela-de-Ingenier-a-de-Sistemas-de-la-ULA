@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto justify-content-center">
                <h3>Solicitud de verificación</h3>
                <form action="{{ route('petitions.store') }}" method="post">
                    @csrf
                    <label for="Cedula">Cédula</label>
                    <div class="form-inline">
                        <select name="nationality" id="nationality" class=" form-control col-1">
                            <option  value="V">V</option>
                            <option  value="E">E</option>
                        </select>
                        <input type="text" name="ID" id="ID" class="form-control col-11" pattern="[0-9]{6,7}[0-9]$" placeholder="12345678" required="true" value={{ old('ID') }} >
                    </div>
                    <p class="alert-warning">Recuerda que debes utilizar el formato solo formato numérico</p>

                    <label for="name">Nombre</label> <input type="name" name="name" id="name" class="form-control" required value={{ old('name') }}>
                    <label for="email" class="mt-2">Correo</label> <input type="email" name="email" id="email" class="form-control" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@ula.ve" placeholder="usuario123@ula.ve" required value={{ old('email') }}>
                    <p class="alert-warning">Recuerda que debes utilizar un correo ula</p>

                    <label for="Escuela" >Escuela</label>
                    <select name="area" id="area" class=" container-fluid form-control">
                        <option value=1>Sistemas computacionales</option>
                        <option value=2>Control y automatización</option>
                        <option value=3>Investigación de operaciones</option>
                    </select>
                    <label for="tiposolicitud" class="mt-2">Tipo de solicitud</label>
                    <select name="request_type" class=" container-fluid form-control">
                        <option value=1>Materias en paralelo</option>
                        <option value=2>Colisión de horarios</option>
                        <option value=3>Exceso de unidades de crédito</option>
                        <option value=4>Proyecto de grado</option>
                    </select>
                    <br>
{{--                     <div class="g-recaptcha mt-4" data-sitekey="a"></div> --}}
                    <input type="submit" value="ENVIAR" id="Enviar" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/jquery/user.js') }}"></script>
    <script src="{{ asset('vendor/google/api.js') }}"></script>
@endsection

