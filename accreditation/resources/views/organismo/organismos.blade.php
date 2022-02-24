@extends('layouts.app')
@section('content')

<div class="section">

    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 py-3">
                <li class="breadcrumb-item"><a class="fw-light" href="/home" style="text-decoration: none;">Inicio</a></li>
                <li class="breadcrumb-item active fw-light" aria-current="page">Organismo</li>
            </ol>
            </nav>
        </div>
    </div>

    <div class="col-12" align="right">
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#crearOrganismo" style="margin-right: 16px ;margin-top: 13px;">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Organismos Acreditadores</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-sm mb-0 table-striped table-sm">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organismos as $organismo)
                            <tr>
                            <td>{{$organismo->id}}</td>
                            <td>{{$organismo->nombre}}</td>
                            <td>
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarOrganismo" href="#" onclick="editOrganismo({{$organismo->id}})">
                                <i class="far fa-edit"></i>
                            </a>
                            <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#eliminarOrganismo" href="#" onclick="deleteOrganismo({{$organismo->id}})">
                                <i class="far fa-trash-alt"></i>
                            </a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {!! $organismos->links() !!}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-start" id="crearOrganismo" tabindex="-1" aria-labelledby="crearOrganismoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearOrganismoLabel">Nuevo Organismo</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- mensajes de validación -->
                <div id="alert_name"></div>

                <form id="form_create_organismo" action="#" method="post" class="form-horizontal">
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="organismoName">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="Name Organismo" class="form-control" id="organismoName" name="organismoName">
                            <small class="form-text">Nombre del Organismo</small>
                        </div>

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

<div class="modal fade text-start" id="editarOrganismo" tabindex="-1" aria-labelledby="editarOrganismoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearOrganismoLabel">Editar Organismo</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- mensajes de validación -->
                <div id="alert_name_edit"></div>

                <form id="form_editar_organismo" action="#" method="post" class="form-horizontal">
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="organismoNameEditar">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="Name Organismo" class="form-control" id="organismoNameEditar" name="organismoNameEditar">
                            <small class="form-text">Nombre del Organismo</small>
                        </div>

                    </div>

                    <input type="hidden" id="organismo_editar" >

                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade text-start" id="eliminarOrganismo" tabindex="-1" aria-labelledby="eliminarOrganismoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioLabel">Eliminar Organismo</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_delete_organismo" class="form-horizontal">
                    <p id="phrase" style="text-align: center;"></p>
                    <input type="hidden" id="organismo_delete">
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                        <button id="btn_close_delete" class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToastCreate" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Organismo </strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Organismo nuevo registrado
        </div>
    </div>

    <div id="liveToastEdit" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Organismo </strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Organismo Actualizado
        </div>
    </div>

    <div id="toastDelete" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Organismo </strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Organismo Eliminado
        </div>
    </div>

    <div id="liveToastError" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: red;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Organismo </strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Error! Algo Sucedio en el registro
        </div>
    </div>
</div>


<script type="application/javascript" src="{{ asset('js/Organismo/organismo.js') }}"></script>

@endsection
