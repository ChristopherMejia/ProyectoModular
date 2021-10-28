@extends('layouts.app')
@section('content')

<div class="section">

    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 py-3">
                <li class="breadcrumb-item"><a class="fw-light" href="/home" style="text-decoration: none;">Inicio</a></li>
                <li class="breadcrumb-item active fw-light" aria-current="page">Programas Educativos</li>
            </ol>
            </nav>
        </div>
    </div>

    <div class="card-header header-table"><h4> Programas Educativos <h4></div>

    <div class="col-12" align="right">
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#crearProgramaEducativo" style="margin-right: 16px ;margin-top: 13px;">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Información de Programas Educativos</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table text-sm mb-0 table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Nivel</th>
                            <th>Acciones<th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programas as $programa)
                        <tr>
                            <td>{{$programa->id}}</td>
                            <td>{{$programa->nombre}}</td>
                            <td>{{$programa->nivel}}</td>
                            <td>
                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarProgramaEducativo" href="#" onclick="editarPrograma({{$programa->id}})">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#eliminarPrograma" href="#" onclick="eliminarPrograma({{$programa->id}})">
                                    <i class="fas fa-user-times"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        {{ $programas->links() }}
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>

</div>

<!-- modal create -->
<div class="modal fade text-start" id="crearProgramaEducativo" tabindex="-1" aria-labelledby="crearProgramaEducativoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearProgramaEducativoLabel">Nuevo Programa Educativo</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- mensajes de validación -->
                <div id="alert_name"></div> 
                <div id="alert_level"></div>

                <form id="form_create_programa" action="#" method="post" class="form-horizontal">
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="nombrePrograma">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="Nombre Programa" class="form-control" id="nombrePrograma" name="nombrePrograma">
                            <small class="form-text">Nombre del programa educativo</small>
                        </div>

                    </div>
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="nivelPrograma">Nivel</label>
                        <div class="col-sm-9">
                            <select class="form-select mb-3" name="nivelPrograma" id="nivelPrograma">
                                <option value="" selected disabled>Selecciona una opción...</option>
                                <option value="Tecnico Superior Universitario"> Tecnico Superior Universitario </option>
                                <option value="Ingeniería"> Ingeniería </option>
                                <option value="Licenciatura"> Licenciatura </option>
                            </select>

                            <small class="form-text">Nivel del programa educativo</small>
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
<!-- modal edit -->
<div class="modal fade text-start" id="editarProgramaEducativo" tabindex="-1" aria-labelledby="editarProgramaEducativoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarProgramaEducativoLabel">Editar Programa Educativo</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- mensajes de validación -->
                <div id="alert_name_editar"></div> 
                <div id="alert_level_editar"></div>

                <form id="form_editar_programa" action="#" method="post" class="form-horizontal">
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="nombreProgramaEditar">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="Nombre Programa" class="form-control" id="nombreProgramaEditar" name="nombreProgramaEditar">
                            <small class="form-text">Nombre del programa educativo</small>
                        </div>

                    </div>
                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="nivelProgramaEditar">Nivel</label>
                        <div class="col-sm-9">
                            <select class="form-select mb-3" name="nivelProgramaEditar" id="nivelProgramaEditar">
                                <!-- <option value="" selected disabled>Selecciona una opción...</option> -->
                                <option value="Tecnico Superior Universitario"> Tecnico Superior Universitario </option>
                                <option value="Ingeniería"> Ingeniería </option>
                                <option value="Licenciatura"> Licenciatura </option>
                            </select>

                            <small class="form-text">Nivel del programa educativo</small>
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

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    
    <div id="liveToastCreate" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Programa Educativo</strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Programa educativo registrado
        </div>
    </div>

    <div id="liveToastError" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: red;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Programa Educativo</strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Error! Algo Sucedio 
        </div>
    </div>

</div>

<script type="application/javascript" src="{{ asset('js/ProgramaEducativo/programaEducativo.js') }}"></script>

@endsection