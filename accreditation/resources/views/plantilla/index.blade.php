@extends('layouts.app')
@section('content')

<div class="section">

  <div class="bg-gray-200 text-sm">
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 py-3">
            <li class="breadcrumb-item"><a class="fw-light" href="/home" style="text-decoration: none;">Inicio</a></li>
            <li class="breadcrumb-item active fw-light" aria-current="page">Plantilla</li>
        </ol>
        </nav>
    </div>
  </div>

    <div class="card">
        <div class="card card-nav-tabs card-plain">
            <div class="card-header header-table">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-pills nav-pills-primary" role="tablist">

                        <li class="nav-item">
                        <a id="select_plantilla" class="nav-link active" data-bs-toggle="tab"  href="#plan" aria-expanded="false">
                            Plantillas
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a id="select_guias" class="nav-link " data-bs-toggle="tab" href="#guias" role="tablist" aria-expanded="false" >
                            Guias
                            </a>
                        </li>

                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <div class="tab-content tab-space">
                        <div  class="tab-pane active" id="plan" aria-expanded="true">
                                <div class="col-12" align="right">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#crearPlantilla" style="margin-right: 16px ;margin-top: 13px;">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo
                                    </button>
                                </div>
                                <div class="card">
                                    <div class="card-header border-bottom">
                                        <h3 class="h4 mb-0">Información de Plantillas</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table text-sm mb-0 table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Organismo</th>
                                                        <th>Versión</th>
                                                        <th>Acciones<th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($plantillas as $plantilla)
                                                    <tr>
                                                    <td>{{$plantilla->id}}</td>
                                                    <td>{{$plantilla->nombre}}</td>
                                                    <td>{{$plantilla->version}}</td>

                                                        <td>
                                                            <a id="guia_create" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearGuia" href="#" onclick="crearGuia({{$plantilla->id}})">
                                                                <i class="fas fa-plus-circle"></i>
                                                            </a>
                                                            <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#eliminarPlantilla" href="#" onclick="eliminarPlantilla({{$plantilla->id}})">
                                                                <i class="fas fa-user-times"></i>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    {{ $plantillas->links() }}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>

    
                <div  class="tab-pane" id="guias" aria-expanded="true">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h3 class="h4 mb-0">Información de Guias</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-sm mb-0 table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Plantilla</th>
                                                <th>Progragama Nivel</th>
                                                <th>Programa Nombre</th>
                                                <th>Coordinador</th>
                                                <th>Estatus</th>
                                                <th>Acciones<th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($guias as $guia)
                                            <tr>
                                            <td>{{$guia['id']}}</td>
                                            <td>{{$guia['plantilla']}}</td>
                                            <td>{{$guia['programa_educativo_nivel']}}</td>
                                            <td>{{$guia['programa_educativo_nombre']}}</td>
                                            <td>{{$guia['nombre_coordinador']}}</td>
                                            <td>{{$guia['status']}}</td>

                                            <td>
                                                <a id="guia_comenzar" class="btn btn-primary" data-bs-toggle="comenzarGuia" data-bs-target="#comenzarGuia"  href="plantillas/iniciar/{{$guia['id']}}">
                                                    <i class="far fa-play-circle"></i>
                                                </a>
                                            </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
</div>




<div class="modal fade text-start" id="crearPlantilla" tabindex="-1" aria-labelledby="crearPlantillaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearPlantillaLabel">Crear Plantilla</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- mensajes de validación -->
                <div id="alert_organismo"></div> 
                <div id="alert_version"></div>

                <form id="form_create_plantilla" action="#" method="post" class="form-horizontal">
                    
                    <div class="row">
                      <label class="col-sm-3 form-label" for="organismoPlantilla">Organismo</label>
                      <div class="col-sm-9">
                        <select class="form-select mb-3" name="organismoPlantilla" id="organismoPlantilla">
                        <option value="" selected disabled>Selecciona una opción...</option>
                            @foreach($organismos as $organismo)
                                <option value="{{$organismo->id}}">{{$organismo->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="version">Versión</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="version" class="form-control" id="version" name="version">
                            <small class="form-text">Tipo de versión con cual trabajar</small>
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

<div class="modal fade text-start" id="crearGuia" tabindex="-1" aria-labelledby="crearGuiaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearGuiaLabel">Comenzar Guia de Evaluación</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- mensajes de validación -->
                <div id="alert_programaEducativo"></div> 
                <div id="alert_coordinador"></div>
                <div id="alert_fecha"></div>


                <form id="form_create_guia" action="#" method="post" class="form-horizontal">
                    
                    <div class="row">
                      <label class="col-sm-3 form-label" for="programaEducativo">Programa Educativo</label>
                      <div class="col-sm-9">
                        <select class="form-select mb-3" name="programaEducativo" id="programaEducativo">
                        <option value="" selected disabled>Selecciona una opción...</option>
                            @foreach($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="coordinador">Coordinador</label>
                        <div class="col-sm-9">
                            <input type="text" aria-label="coordinador" class="form-control" id="coordinador" name="coordinador">
                            <small class="form-text">Nombre del Coordinador</small>
                        </div>
                    </div>

                    <div class="row gy-2 mb-4">
                        <label class="col-sm-3 form-label" for="fecha">Fecha</label>
                        <div class="col-sm-9">
                            <input type="date" aria-label="fecha" class="form-control" id="fecha" name="fecha" min="2018-01-01" max="2030-12-31">
                            <small class="form-text">Fecha de Inicio</small>
                        </div>
                    </div>

                    <input type="hidden" id="id_plantilla">
                    
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button id="close_guia_modal" class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
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
        <strong class="me-auto"> Plantilla </strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Plantilla nueva registrada
        </div>
    </div>

    <div id="liveToastEdit" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto"> Plantilla </strong>
        <small>hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        ¡Correcto! Plantilla Actualizado
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
        ¡Correcto! Plantilla Eliminada
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


<script type="application/javascript" src="{{ asset('js/Plantilla/plantilla.js') }}"></script>

@endsection