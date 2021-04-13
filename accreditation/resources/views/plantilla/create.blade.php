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
                <div class="card-header header-table"><h4>Plantilla<h4></div>
                <div class="card-body">

                    <form action="/plantilla/save" method="POST">
                        @csrf
                        <div class="form-group" > 
                            <label for="selected" class="form-label"><h4>Organismo</h4></label>
                            <select class="form-select" aria-label="Default select example" id="selected" name="idOrganismo">
                            <option selected disabled>Abrir este menú de selección</option>
                                @foreach($organismos as $orgs)
                                    <option value="{{$orgs->id}}">{{$orgs->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" >
                            <label for="version" class="form-label " style="text-align: end"><h4>Versión</h4></label>
                            <input type="text"  class="form-control" name="version" placeholder="Nueva Versión"></input>
                        </div>
                        <div class="d-grid gap-2" >
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection