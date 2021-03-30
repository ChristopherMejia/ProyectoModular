@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header header-table"><h3>Plantillas<h3></div>
                <div class="card-body">
                <table class="table table-hover table-sm" style="text-align: center;">
                    <thead>
                        <th>Organismo</th>
                        <th>Versión</th>
                        <th colspan=2>Acciones</th>
                    </thead>
                    @foreach($plantillas as $plantilla)
                        <tr>
                            <td>{{$plantilla->nombre}}</td>
                            <td>{{$plantilla->version}}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-plantilla" id="button_delete">
                                    <span class="material-icons" data-id="{{$plantilla->id}}" data-name="{{$plantilla->nombre}}">delete_outline</span>
                                </button>
                            </td>
                           
                        </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>

     <!-- Modal Delete -->
        <div class="modal fade" id="delete-plantilla" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header delete">
                <h5 class="modal-title" id="staticBackdropLabel">Borrar Plantilla</h5>
              </div>
              <div class="modal-body">
                <form action="/plantilla/delete" method="post">
                @csrf
                  <div class="form-group">
                    <label class="form-label">¿Seguro que desea eliminarlo?</label>
                    <input type="text" name="name" class="form-control" id="name_delete" disabled>
                    <input type="hidden" name="id" id="delete_id">
                  </div>
                  <div class="modal-footer">
                    <button id="btn-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>

@endsection