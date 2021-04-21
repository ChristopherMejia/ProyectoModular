@extends('layouts.app')
@section('content')

<div class="main-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
                <div class="card-header header-table"><h4>Programa Educativo<h4></div>
                <div class="card-body">

                <form action="programa-educativo/save" method="post">
                @csrf

                <div class="input-group mb-3">
                    <input type="text" class="form-control" 
                            placeholder="Nombre Programa Educativo" 
                            aria-label="educacion"
                            name="educacion">
                    <span class="input-group-text"></span>
                    <select class="form-select" aria-label="Default select example" id="nivel" name="nivel">
                        <option selected disabled>Nivel</option>
                        <option value="Educación Inicial">Educación Inicial</option>
                        <option value="Educación Basica">Educación Básica</option>
                        <option value="Educación Media Superior">Educación Media Superior</option>
                        <option value="Educación Superior">Educación Superior</option>
                        <option value="Educación Tecnologica">Educación Tecnologica</option>
                    </select>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-success" type="submit">Crear</button>
                </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection