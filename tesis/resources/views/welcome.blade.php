@extends('layouts.app')

@section('content')

    {{--**********************************************Trámites *****************************************************--}}
    <div class="container">

        {{--************************************Primera fila********************************************************--}}
        <div class="row mx-auto justify-content-center">

            {{--*************************************Trámite uno**********************************************--}}
            <div class="col-6">
                <div class="card ">
                    <div class="card-header">
                        <img src="/img/sistema.png" class="w-50 mx-auto d-block">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" align="center">Trámite para materias en paralelo <br><br></h3>

                        <p class="card-text text-justify">Se solicita este proceso cuando el estudiante desea inscribir una materia
                            en el semestre actual, la cual es prelada por una materia que el mismo no ha aprobado anteriormente</p>

                        {{--**********************************************************************************************************--}}
                        {{--Botón modal--}}
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal">Ver requisitos</button>

                        {{--El modal--}}
                        <div class="modal fade" id="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    {{--Header--}}

                                    <div class="modal-header">
                                        <h4 class="modal-title">Requesitos para materias en paralelo</h4>
                                        <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                                    </div>

                                    {{--Body--}}
                                    <div class="modal-body">
                                        <ul>
                                            <li class="list-group-item-light">Selección de materias generada por el sistema</li>
                                            <li class="list-group-item-light">Constacia de notas expedidad por SIRE, no es necesaria que este firmada</li>
                                            <li class="list-group-item-light">Una carta con motivo, explicando la razón por la que se solicita el trámite (<a href="{{asset(\Config::get('constants.Carta_de_motivo_mp'))}}"download>Ejemplo de carta</a>)</li>
                                            <li class="list-group-item-light">Se deberá tener cuenta de de correo electrónico de la ULA</li>
                                        </ul>
                                        <p class="alert-success">Una vez haya reunido todos los recaudos de la lista, procesa a solcitar este trámite en la opción
                                            <a href="/Solicitud">solicitar</a></p>
                                    </div>

                                    {{--Footer--}}
                                    <div class="modal-footer">
                                        <p class="alert-warning"> Todos los documentos deberán estar en formato PDF, de poseer algún documento en físico
                                            deberá ser escaneado y ser guardado en dicho formato</p>
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--***************************************************************************************************************--}}
                    </div>
                </div>
            </div>

            {{--*************************************Trámite dos**********************************************--}}
            <div class="col-6">
                <div class="card ">
                    <div class="card-header">
                        <img src="/img/sistema.png" class="w-50 mx-auto d-block">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" align="center">Trámite para exceso de unidades de crédito</h3>
                        <p class="card-text text-justify">Se solicita este trámite cuando el estudiante desea inscribir una materia en
                            el semestra actual, pero el mismo se ve limitado por las unidades de créditos reglamentarias. </p>
                        {{--**********************************************************************************************************--}}
                        {{--Botón modal--}}
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal2">Ver requisitos</button>

                        {{--El modal--}}
                        <div class="modal fade" id="modal2">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    {{--Header--}}

                                    <div class="modal-header">
                                        <h4 class="modal-title">Requesitos para exceso de unidades de crédito</h4>
                                        <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                                    </div>

                                    {{--Body--}}
                                    <div class="modal-body">
                                        <ul>
                                            <li class="list-group-item-light">Selección de materias generada por el sistema</li>
                                            <li class="list-group-item-light">Constacia de notas expedidad por SIRE, no es necesaria que este firmada</li>
                                            <li class="list-group-item-light">Una carta con motivo, explicando la razón por la que se solicita el trámite (<a href="{{asset(\Config::get('constants.Carta_de_motivo_euc'))}}"download>Ejemplo de carta</a>)</li>
                                            <li class="list-group-item-light">Se deberá tener cuenta de de correo electrónico de la ULA</li>
                                        </ul>
                                        <p class="alert-success">Una vez haya reunido todos los recaudos de la lista, procesa a solcitar este trámite en la opción
                                            <a href="/Solicitud">solicitar</a></p>
                                    </div>

                                    {{--Footer--}}
                                    <div class="modal-footer">
                                        <p class="alert-warning"> Todos los documentos deberán estar en formato PDF, de poseer algún documento en físico
                                            deberá ser escaneado y ser guardado en dicho formato</p>
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--***************************************************************************************************************--}}
                    </div>
                </div>
            </div>
        </div>
        <hr>
        {{--**********************************************Segunda fila *********************************************--}}
        <div class="row mx-auto justify-content-center">

            {{--*************************************Trámite tres**********************************************--}}
            <div class="col-6">
                <div class="card ">
                    <div class="card-header">
                        <img src="/img/sistema.png" class="w-50 mx-auto d-block">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" align="center">Trámite para colisión de horarios <br><br></h3>
                        <p class="card-text text-justify">Se solicita este trámite cuando el estudiante desea inscribir una materia en
                            el semestre actual, pero la misma presenta genera un exceso en la unidades de créditos reglamentarias</p>
                        {{--**********************************************************************************************************--}}
                        {{--Botón modal--}}
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal3">Ver requisitos</button>

                        {{--El modal--}}
                        <div class="modal fade" id="modal3">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    {{--Header--}}

                                    <div class="modal-header">
                                        <h4 class="modal-title">Requesitos para colisión de horarios</h4>
                                        <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                                    </div>

                                    {{--Body--}}
                                    <div class="modal-body">
                                        <ul>
                                            <li class="list-group-item-light">Selección de materias generada por el sistema</li>
                                            <li class="list-group-item-light">Constacia de notas expedidad por SIRE, no es necesaria que este firmada</li>
                                            <li class="list-group-item-light">Una carta con motivo, explicando la razón por la que se solicita el trámite(<a href="{{asset(\Config::get('constants.Carta_de_motivo_ch'))}}"download>Ejemplo de carta</a>)</li>
                                            <li class="list-group-item-light">Horario marcando las horas en donde se presenta la colisiones, el nombre de las materias que colsionan y secciones de dichas materias(<a href="{{asset(\Config::get('constants.Horario'))}}"download>Ejemplo de horario</a>)</li>
                                            <li class="list-group-item-light">Se deberá tener cuenta de de correo electrónico de la ULA</li>
                                        </ul>
                                        <p class="alert-success">Una vez haya reunido todos los recaudos de la lista, procesa a solcitar este trámite en la opción
                                            <a href="/Solicitud">solicitar</a></p>
                                    </div>

                                    {{--Footer--}}
                                    <div class="modal-footer">
                                        <p class="alert-warning"> Todos los documentos deberán estar en formato PDF, de poseer algún documento en físico
                                            deberá ser escaneado y ser guardado en dicho formato</p>
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--***************************************************************************************************************--}}
                    </div>
                </div>
            </div>

            {{--*************************************Trámite cuatro**********************************************--}}
            <div class="col-6">
                <div class="card ">
                    <div class="card-header">
                        <img src="/img/sistema.png" class="w-50 mx-auto d-block">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title" align="center">Trámite para inscripción de proyecto de grado</h3>
                        <p class="card-text text-justify">Se solicita este trámite cuando el estudiante de último semestre desea formalizar
                            su inscripción de tesis</p>
                            <br>
                        {{--**********************************************************************************************************--}}
                        {{--Botón modal--}}
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal4">Ver requisitos</button>

                        {{--El modal--}}
                        <div class="modal fade" id="modal4">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    {{--Header--}}

                                    <div class="modal-header">
                                        <h4 class="modal-title">Requesitos para para inscripción de proyecto de grado</h4>
                                        <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                                    </div>

                                    {{--Body--}}
                                    <div class="modal-body">
                                        <ul>
                                            <li class="list-group-item-light">Propuesta de tesis</li>
                                            <li class="list-group-item-light">Carta con la propuesta de tesis (<a href="{{asset(\Config::get('constants.Carta_propuesta'))}}"download>Ejemplo de carta de propuesta</a>)</li>
                                            <li class="list-group-item-light">Descripción de la propuesta de tesis(<a href="{{asset(\Config::get('constants.Descripcion_propuesta'))}}"download>Ejemplo de la descripcion de la propuesta</a>)</li>
                                            <li class="list-group-item-light">Carta de compromiso del profesor tutor de la tesis del estudiante(<a href="{{asset(\Config::get('constants.Carta_compromiso'))}}"download>Ejemplo de carta de compromiso</a>)</li>
                                            <li class="list-group-item-light">Se deberá tener cuenta de de correo electrónico de la ULA</li>
                                        </ul>
                                        <p class="alert-success">Una vez haya reunido todos los recaudos de la lista, procesa a solcitar este trámite en la opción
                                            <a href="/Solicitud">solicitar</a></p>
                                    </div>

                                    {{--Footer--}}
                                    <div class="modal-footer">
                                        <p class="alert-warning"> Todos los documentos deberán estar en formato PDF, de poseer algún documento en físico
                                            deberá ser escaneado y ser guardado en dicho formato</p>
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--***************************************************************************************************************--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

