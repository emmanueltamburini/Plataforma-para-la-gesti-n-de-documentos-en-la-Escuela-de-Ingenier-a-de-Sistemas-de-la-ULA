@extends('layouts.app')

@section('content')
    @csrf

    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto justify-content-center">
                <h1>Formulario para solicitar exceso de unidades de crédito</h1>
                <form action="{{ route('request.excess_credit_units_post',['ID'   =>  session('ID') ,'code' =>  session('code')]) }}" method="post" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="Selección de materias">Selección de materias</label> <input type="file" name="subjects_selection" class="form-control" required="true" accept="application/pdf">
                    {{-- ***************************Marcando errores********************************** --}}
                    {!! $errors->first('subjects_selection', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="error">:message</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>')!!}
                    <label for="Constancia de notas">Constancia de notas</label> <input type="file" name="proof_notes" class="form-control" required="true" accept="application/pdf">
                    {{-- ***************************Marcando errores********************************** --}}
                    {!! $errors->first('proof_notes', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="error">:message</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>')!!}
                    <label for="Carta de motivo">Carta de motivo</label> <input type="file" name="reason_letter" class="form-control" required="true" accept="application/pdf">
                    {{-- ***************************Marcando errores********************************** --}}
                    {!! $errors->first('reason_letter', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="error">:message</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>')!!}
                    <ul>
                        <li class="list-group-item-info mt-5"">
                            Recuerde que solo se permite formato PDF
                        </li>
                    </ul>
                    <input type="submit" value="ENVIAR" id="Enviar" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </div>
@endsection

