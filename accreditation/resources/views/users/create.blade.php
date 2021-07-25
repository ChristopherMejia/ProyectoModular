@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="row justify-content-center">
        <div class=" col-md-12">
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

                <div class="card-header header-table"><h4>Formulario de Usuarios<h4></div>
                <div class="card-body">

                <form action="users" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombre y Apellido</span>
                        <input type="text" aria-label="First name" class="form-control" placeholder="Nombre" id="FirstName" name="FirstName">
                        <input type="text" aria-label="Last name" class="form-control" placeholder="Apellido" id="LastName" name="LastName">
                    </div>
                    <div class="input-group mb-3">
                        
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon2" name="email">
                        <span class="input-group-text" id="basic-addon2">@ejemplo.com</span>
                        
                        <select class="form-select" id="inputGroupRoles" name="inputGroupRoles">
                            <option selected disabled>Selecciona una opción...</option>
                            <option value="1">Administrador</option>
                            <option value="2">Operador</option>
                            <option value="3">Usuario</option>
                        </select>
                        <label class="input-group-text" for="inputGroupSelect01">Roles</label>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña" name="password">
                    </div>
                    
                    <button type="submit" class="btn btn-success" >Aceptar</button>
                </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection