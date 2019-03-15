@extends('layouts.app')

@section('content')
    @csrf

    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto justify-content-center ">
                <h1>Formulario para proyecto de grado</h1>
                <form action="{{ route('request.graduation_project_post',['ID'   =>  session('ID') ,'code' =>  session('code')]) }}" method="post" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <label for="Carta de la Propuesta">Carta de la propuesta de proyecto de grado</label> <input type="file" name="grade_project_proposal_letter" class="form-control" required="true" accept="application/pdf">
                    {{-- ***************************Marcando errores********************************** --}}
                    {!! $errors->first('grade_project_proposal_letter', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="error">:message</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>')!!}
                    <label for="Propuesta">Propuesta de proyecto de grado</label> <input type="file" name="grade_project_proposal" class="form-control" required="true" accept="application/pdf">
                    {{-- ***************************Marcando errores********************************** --}}
                    {!! $errors->first('grade_project_proposal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="error">:message</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>')!!}
                    <label for="Descripcion de la propuesta">Descripción de la Propuesta</label> <input type="file" name="description_proposal" class="form-control" required="true" accept="application/pdf">
                    {{-- ***************************Marcando errores********************************** --}}
                    {!! $errors->first('description_proposal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="error">:message</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>')!!}
                    <label for="Carta de compromiso">Carta de compromiso</label> <input type="file" name="letter_engagement" class="form-control" required="true" accept="application/pdf">
                    {{-- ***************************Marcando errores********************************** --}}
                    {!! $errors->first('letter_engagement', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
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

