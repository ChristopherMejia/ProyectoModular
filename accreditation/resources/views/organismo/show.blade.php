@extends('layouts.app')
@section('content')
<div class="main-container">

    <table class="table table-hover table-sm">
        <thead class=" table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($Organismos as $organismo)
            <tr>
                <td id="organismoId" scope="row">{{$organismo->id}}</td>
                <td id="organismoNombre"scope="row">{{$organismo->nombre}}</td>
                <td>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit-item" id="btnEdit">
                    <span class="material-icons" data-id="{{$organismo->id}}" data-name="{{$organismo->nombre}}">mode_edit</span>
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <span class="material-icons">delete_outline</span>
                </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

  <!-- Modal Edit -->
  <div class="modal fade" id="edit-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar Organismo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <input id="nameToEdit" type="text" class="form-control" disabled>
          <form action="/organismo/edit" method="post">
          @csrf
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre">
              <input type="hidden" name="id" id="editId">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
           
</div>
@endsection