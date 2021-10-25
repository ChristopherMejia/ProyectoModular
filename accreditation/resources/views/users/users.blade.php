@extends('layouts.app')
@section('content')

<div class="section">

    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 py-3">
                <li class="breadcrumb-item"><a class="fw-light" href="/home" style="text-decoration: none;">Inicio</a></li>
                <li class="breadcrumb-item active fw-light" aria-current="page">Usuario</li>
            </ol>
            </nav>
        </div>
    </div>

    <div class="card-header header-table"><h4> Usuarios <h4></div>
    
    <div class="col-12" align="right">
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#crearUsuario" style="margin-right: 16px ;margin-top: 13px;">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Información de Usuarios</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table text-sm mb-0 table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Acciones<th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarUsuario" href="#" onclick="editaUsuario({{$user->id}})">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#eliminarUsuario" href="#" onclick="eliminarUsuario({{$user->id}})">
                                    <i class="fas fa-user-times"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        {{ $users->links() }}
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>

</div>

<!-- modal to create user -->
<div class="modal fade text-start" id="crearUsuario" tabindex="-1" aria-labelledby="crearUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioLabel">Nuevo Usuario</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- mensajes de validación -->
                <div id="alert_name"></div> 
                <div id="alert_email"></div>
                <div id="alert_role"></div>
                <div id="alert_password"></div>

                <form id="form_create_user" action="#" method="post" class="form-horizontal">
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="FirstName">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="First name" class="form-control" id="FirstName" name="FirstName">
                            <small class="form-text">Nombre del usuaria</small>
                        </div>

                    </div>
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="LastName">Apellido</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="Last name" class="form-control" id="LastName" name="LastName">
                            <small class="form-text">Apellido del usuario</small>
                        </div>

                    </div>

                    <div  class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="email">Email</label>
                        <div class="col-sm-9">
                        <input id="email" type="email" class="form-control" aria-label="Email" aria-describedby="email_help" name="email">
                        <small class="form-text">No se compatira tu email con nadie</small>
                        </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-3 form-label" for="inputGroupSelect01">Roles</label>
                      <div class="col-sm-9">
                        <select class="form-select mb-3" name="inputGroupRoles" id="inputGroupRoles">
                        <option value="" selected disabled>Selecciona una opción...</option>
                            <option value="1">Director</option>
                            <option value="2">Coordinador</option>
                            <option value="3">Maestro</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" id="password" type="password" placeholder="Contraseña">
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- modal to edit user -->
<div class="modal fade text-start" id="editarUsuario" tabindex="-1" aria-labelledby="editarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioLabel">Editar Usuario</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- mensajes de validación -->
                <div id="alert_name_edit"></div> 
                <div id="alert_email_edit"></div>
                <div id="alert_role_edit"></div>

                <form id="form_create_user_edit" action="#" method="post" class="form-horizontal">
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="FirstNameEdit">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="First name" class="form-control" id="FirstNameEdit" name="FirstNameEdit">
                            <small class="form-text">Nombre del usuaria</small>
                        </div>

                    </div>
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="LastNameEdit">Apellido</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="Last name" class="form-control" id="LastNameEdit" name="LastNameEdit">
                            <small class="form-text">Apellido del usuario</small>
                        </div>

                    </div>

                    <div  class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="email_edit">Email</label>
                        <div class="col-sm-9">
                        <input id="email_edit" type="email" class="form-control" aria-label="Email" aria-describedby="email_help" name="email_edit">
                        <small class="form-text">No se compartira tu email con nadie</small>
                        </div>
                    </div>

                    <div class="row">
                      <label class="col-sm-3 form-label" for="rolesEdit">Roles</label>
                      <div class="col-sm-9">
                        <select class="form-select mb-3" name="rolesEdit" id="rolesEdit">
                        </select>
                      </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_edit">Contraseña</label>
                        <input class="form-control" id="password_edit" type="password" placeholder="Contraseña">
                    </div>

                    <input type="hidden" id="user_id" value="">
                    
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button id="btn_close_edit" class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-start" id="eliminarUsuario" tabindex="-1" aria-labelledby="eliminarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioLabel">Eliminar Usuario</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_delete_user" class="form-horizontal">
                    <p id="phrase" style="text-align: center;"></p>
                    <input type="hidden" id="user_delete">
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Aceptar</button>
                        <button id="btn_close_delete" class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- mensajes de error y success -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToastCreate" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Usuario</strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Usuario nuevo registrado
        </div>
    </div>

    <div id="liveToastEdit" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Usuario</strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Usuario Actualizado
        </div>
    </div>

    <div id="toastDelete" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Usuario</strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Usuario Eliminado
        </div>
    </div>

    <div id="liveToastError" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: red;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Usuario</strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Error! Algo Sucedio 
        </div>
    </div>
</div>

<script type="application/javascript" src="{{ asset('js/Usuarios/crear.js') }}"></script>


@endsection
