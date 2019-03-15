@extends('layouts.app')

@section('content')
    @csrf

    <p class="alert-success text-center"> Usuario con C.I:111111 encontrado con éxito</p>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <table class="table  table-hover table-primary ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="active">Solicitud</th>
                            <th scope="col" class="active">Tipo</th>
                            <th scope="col" class="active">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Colisión de horarios</td>
                            <td>
                                Rechazada
                                {{--**********************************************************************************************************--}}
                                {{--Botón modal--}}
                                <button type="button" class="btn btn-primary badge" data-toggle="modal" data-target="#modal">i</button>

                                {{--El modal--}}
                                <div class="modal fade" id="modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            {{--Header--}}

                                            <div class="modal-header">
                                                <h4 class="modal-title">Estado solicitud</h4>
                                                <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                                            </div>

                                            {{--Body--}}
                                            <div class="modal-body">
                                                <div class="alert-danger">Solicitud negada por documentos incompletos</div>
                                            </div>

                                            {{--Footer--}}
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="button" data-dismiss="modal">cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--***************************************************************************************************************--}}
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Rompimiento de prelaciones</td>
                            <td>
                                En proceso
                                {{--**********************************************************************************************************--}}
                                {{--Botón modal--}}
                                <button type="button" class="btn btn-primary badge" data-toggle="modal" data-target="#modal2">i</button>

                                {{--El modal--}}
                                <div class="modal fade" id="modal2">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            {{--Header--}}

                                            <div class="modal-header">
                                                <h4 class="modal-title">Estado solicitud</h4>
                                                <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                                            </div>

                                            {{--Body--}}
                                            <div class="modal-body">
                                                <div class="alert-info">Solicitud en proceso, esperando por consejo de facultad</div>
                                            </div>

                                            {{--Footer--}}
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="button" data-dismiss="modal">cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--***************************************************************************************************************--}}
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Exceso de unidades de crédito</td>
                            <td>
                                Aprobada
                                {{--**********************************************************************************************************--}}
                                {{--Botón modal--}}
                                <button type="button" class="btn btn-primary badge" data-toggle="modal" data-target="#modal3">i</button>

                                {{--El modal--}}
                                <div class="modal fade" id="modal3">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            {{--Header--}}

                                            <div class="modal-header">
                                                <h4 class="modal-title">Estado solicitud</h4>
                                                <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                                            </div>

                                            {{--Body--}}
                                            <div class="modal-body">
                                                <div class="alert-success">Solicitud aprobada</div>
                                            </div>

                                            {{--Footer--}}
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="button" data-dismiss="modal">cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--***************************************************************************************************************--}}
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="col btn-group justify-content-center">
        <button type="button" class="btn btn-success">Buscar</button>
        <button type="button" class="btn btn-primary">Inicio</button>
    </div>



@endsection

