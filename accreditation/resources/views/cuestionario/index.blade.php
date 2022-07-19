@extends('layouts.app')
@section('content')
  <div class="section">

    <div class="bg-gray-200 text-sm">
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 py-3">
            <li class="breadcrumb-item"><a class="fw-light" href="/home" style="text-decoration: none;">Inicio</a></li>
            <li class="breadcrumb-item active fw-light" aria-current="page">Cuestionario</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="card">
      <div class="card card-nav-tabs card-plain">
        <div class="card-header header-table">

          <div class="card-body">

            <div class="tab-pane" id="guias" aria-expanded="true">
                <div class="col-12" align="right">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#crearCuestionario" style="margin-right: 16px ;margin-top: 13px;">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo Cuestionario
                    </button>
                </div>
              <div class="card">
                <div class="card-header border-bottom">
                  <h3 class="h4 mb-0">Información de Cuestionarios</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table text-sm mb-0 table-striped table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Plantilla</th>
                          <th>Versión</th>
                          <th>Programa Nivel</th>
                          <th>Programa Nombre</th>
                          <th>Coordinador</th>
                          <th>Estatus</th>
                          <th>Acciones
                          <th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cuestionarios as $cuestionario)
                          <tr>
                            <td>{{ $cuestionario['id'] }}</td>
                            <td>{{ $cuestionario['plantilla'] }}</td>
                            <td>{{ $cuestionario['version'] }}</td>
                            <td>{{ $cuestionario['programa_educativo_nivel'] }}</td>
                            <td>{{ $cuestionario['programa_educativo_nombre'] }}</td>
                            <td>{{ $cuestionario['nombre_coordinador'] }}</td>
                            <td>{{ $cuestionario['status'] }}</td>

                            <td>
                              <a id="cuestionario_editar" class="btn btn-primary"
                                href="{{ URL('/cuestionario/edit/' . $cuestionario['id']) }}">
                                <i class="fas fa-edit" title="Editar" data-bs-placement="right"
                                  data-bs-toggle="tooltip"></i>
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




  <div class="modal fade text-start" id="crearCuestionario" tabindex="-1" aria-labelledby="crearCuestionarioLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearCuestionarioLabel">Crear Cuestionario</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- mensajes de validación -->
          <div id="alert_guia"></div>

          <form id="form_create_cuestionario" action="#" method="post" class="form-horizontal">
            <div class="row">
              <label class="col-sm-3 form-label" for="guiaCuestionario">Guia</label>
              <div class="col-sm-9">
                <select class="form-select mb-3" name="guiaCuestionario" id="guiaCuestionario">
                  <option value="" selected disabled>Selecciona una opción...</option>
                  @foreach ($guias as $guia)
                    <option value="{{ $guia->id }}">
                      {{ $guia->plantillas->version . ' ' . $guia->programasEducativos->nombre }}</option>
                  @endforeach
                </select>
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


  <div class="modal fade text-start" id="eliminarCuestionario" tabindex="-1" aria-labelledby="eliminarCuestionarioLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eliminarCuestionarioLabel">Eliminar Cuestionario</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="form_delete_plantilla" action="#" method="post" class="form-horizontal">

            <div class="row">
              <p id="phrase" style="text-align: center;"></p>
              <input type="hidden" id="delete_plantilla">
            </div>
            <div class="row" style="text-align: center;">
              <p id="phrase_secondary" style="text-align: center;">
              <h5> ¿Seguro que desea eliminar este cuestionario?</h5>
              </p>
            </div>

            <div class="modal-footer">
              <button class="btn btn-danger" type="submit">Eliminar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cerrar</button>
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
        <strong class="me-auto" style="color: white"> Plantilla </strong>
        <small style="color: white">hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        ¡Correcto! Plantilla nueva registrada
      </div>
    </div>

    <div id="liveToastEdit" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto" style="color: white"> Plantilla </strong>
        <small style="color: white">hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        ¡Correcto! Plantilla Actualizada
      </div>
    </div>

    <div id="toastDelete" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header" style="background-color: #0d6efd;">
        <i class="fas fa-users"></i>
        <strong class="me-auto" style="color: white"> Plantilla </strong>
        <small style="color: white">hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        ¡Correcto! Plantilla Eliminada
      </div>
    </div>

    <div id="liveToastError" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header" style="background-color: red;">
        <i class="fas fa-users"></i>
        <strong class="me-auto" style="color: white"> Plantilla </strong>
        <small style="color: white">hace 1 minuto</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        ¡Error! Algo Sucedio
      </div>
    </div>
  </div>


  <script type="application/javascript" src="{{ asset('js/Cuestionario/cuestionario.js') }}"></script>
@endsection
