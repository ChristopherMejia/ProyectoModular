@extends('layouts.app')
@section('content')

<div class="section">

    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 py-3">
                <li class="breadcrumb-item"><a class="fw-light" href="/home">Inicio</a></li>
                <li class="breadcrumb-item active fw-light" aria-current="page">Usuario </li>
            </ol>
            </nav>
        </div>
    </div>

    <div class="card-header header-table"><h4>Nuevo Usuario<h4></div>

    <div class="card-body">

        <form id="form_create_user" action="users" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text">Nombre y Apellido</span>
                <input type="text" aria-label="First name" class="form-control" placeholder="Nombre" id="FirstName" name="FirstName">
                <input type="text" aria-label="Last name" class="form-control" placeholder="Apellido" id="LastName" name="LastName">
            </div>
            <div class="input-group mb-3">
                
                <input id="email" type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon2" name="email">
                <span class="input-group-text" id="basic-addon2">@ejemplo.com</span>
                
                <select class="form-select" id="inputGroupRoles" name="inputGroupRoles">
                    <option value="" selected disabled>Selecciona una opción...</option>
                    <option value="1">Director</option>
                    <option value="2">Coordinador</option>
                    <option value="3">Maestro</option>
                </select>

                <label class="input-group-text" for="inputGroupSelect01">Roles</label>

            </div>

            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña" name="password">
            </div>
            
            <button type="submit" class="btn btn-success" >Aceptar</button>
        </form>

    </div>

    <div id="alert_name"></div>
    <div id="alert_email"></div>
    <div id="alert_role"></div>
    <div id="alert_password"></div>


    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Usuario</strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Usuario nuevo registrado
        </div>
    </div>

    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Usuario</strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Error! Usuario nuevo no registrado
        </div>
    </div>
    </div>

</div>

<script type="application/javascript" src="{{ asset('js/Usuarios/crear.js') }}"></script>


@endsection