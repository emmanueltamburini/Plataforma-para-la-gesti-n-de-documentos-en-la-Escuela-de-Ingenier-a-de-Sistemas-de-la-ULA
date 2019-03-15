@extends('layouts.app')

@section('content')
    @csrf
    <div class="container">
        <div class="row mx-auto">
            <div class="col justify-content-center">
                <h3 class=" text-center">Búscador de solicitudes</h3>
                <form action="{{ route('search.find_post') }}" method="post">
                    @csrf
                    <div class="form-inline justify-content-center">
                        Cédula &nbsp;
                        <select name="nationality" class=" form-control">
                            <option value="V">V</option>
                            <option value="E">E</option>
                        </select>
                        <input type="text" name="ID" class="form-control col-4" pattern="[0-9]{6,7}[0-9]$" placeholder="12345678" required="true" value={{ old('ID') }}>
                        <button type="submit" id="Buscar" class="btn btn-success">Buscar</button>

                    </div>
                    <br><br><br><br><br><br><br><br>
                </form>
            </div>
        </div>
    </div>


@endsection

