@extends('layouts.app')

@section('content')

    @if($status_check)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $status_check }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($status_danger)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $status_danger }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                @if($petitions)
                    <table class="table  table-hover table-primary ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="active">Solicitud</th>
                                <th scope="col" class="active">Tipo</th>
                                <th scope="col" class="active">Estado</th>
                                <th scope="col" class="active">Fecha</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($petitions as $petition)
                                <tr>
                                    <td>{{ $petition['ID_user']."-".$petition['id'] }}</td>
                                    <td>{{ $petition->request_type()->get()[0]->info }}</td>
                                    <td>
                                        {{ $petition->status()->get()[0]->info }}
                                        {{--**********************************************************************************************************--}}
                                        {{--Botón modal--}}
                                        <button type="button" class="btn btn-primary badge" data-toggle="modal" data-target="#modal{{ $petition['id'] }}" id="I{{ $petition['id'] }}">i</button>

                                        {{--El modal--}}
                                        <div class="modal fade" id="modal{{ $petition['id'] }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    {{--Header--}}

                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Estado solicitud</h4>
                                                        <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    {{--Body--}}
                                                    <div class="modal-body">
                                                        <div class="alert-info">{{ $petition['info'] }}</div>
                                                    </div>

                                                    {{--Footer--}}
                                                    <div class="modal-footer">
                                                        <button class="btn btn-info" type="button" data-dismiss="modal">cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--***************************************************************************************************************--}}
                                    </td>
                                    <td> {{  DATE_FORMAT($petition['created_at'], "d-m-Y")  }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="col btn-group justify-content-center">
        <button type="button" class="btn btn-success" onclick="location.href='/Seguimiento'">Buscar</button>
        <button type="button" class="btn btn-primary" onclick="location.href='/'">Inicio</button>
        @if($status_check)
            <button type="button" class="btn btn-info" id="Send" title="Enviar peticioes a su email"><img src="/img/email.png" alt="Email" style="height: 30px;" data-toggle="modal" data-target="#modal"></button>
            {{--El modal--}}
            <div class="modal fade" id="modal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        {{--Header--}}
                        <div class="modal-header">
                            <h4 class="modal-title">Enviar correo</h4>
                            <button type="button" class="btn btn-primary close" data-dismiss="modal">&times;</button>
                        </div>

                        {{--Body--}}
                        <div class="modal-body">
                            <div class="alert-info text-center">¿Desea enviar las peticiones a el correo electrónico asociado a esta cédula?</div>
                        </div>

                        {{--Footer--}}
                        <div class="modal-footer">
                            <form action="{{ route('send',['ID'   =>  $petitions->first()->ID_user]) }}" method="post">
                                @csrf
                                <button class="btn btn-success"  type="submit" id="Accept_send">Enviar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal" id="Cancel_send">Cerrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

