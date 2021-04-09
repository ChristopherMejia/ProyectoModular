@extends('layouts.app')
@section('content')

<div class="main-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-table"><h3>Programa Educativo<h3></div>
                <div class="card-body">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nombre Programa Educativo" aria-label="Username">
                    <span class="input-group-text"></span>
                    <select class="form-select" aria-label="Default select example" id="" name="">
                        <option selected disabled>Nivel</option>
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection