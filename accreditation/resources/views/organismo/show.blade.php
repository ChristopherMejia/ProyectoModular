@extends('layouts.app')
@section('content')
<div class="main-container">

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
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-item" id="btnDelete">
                    <span class="material-icons" data-id="{{$organismo->id}}" data-name="{{$organismo->nombre}}">delete_outline</span>
                </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $Organismos->links() }}

  <!-- Modal Edit -->
  <div class="modal fade" id="edit-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar Organismo</h5>
        </div>
        <div class="modal-body">
        <label class="form-label">Nombre Organismo</label>
        <input id="nameToEdit" type="text" class="form-control" disabled>
          <form action="/organismo/edit" method="post">
          @csrf
            <div class="form-group">
              <label class="form-label">Nuevo Nombre</label>
              <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre" id="newName" required>
              <input type="hidden" name="id" id="editId">
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

   <!-- Modal Delete -->
   <div class="modal fade" id="delete-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header delete">
          <h5 class="modal-title" id="staticBackdropLabel">Borrar Organismo</h5>
        </div>
        <div class="modal-body">
          <form action="/organismo/delete" method="post">
          @csrf
            <div class="form-group">
              <label class="form-label">¿Seguro que desea eliminarlo?</label>
              <input type="text" name="name" class="form-control" id="deleteName" disabled>
              <input type="hidden" name="id" id="deleteId">
            </div>
            <div class="modal-footer">
              <button id="btn-close-dlt" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
           
</div>
<script type="application/javascript" src="{{ asset('js/organismo.js') }}"></script>
@endsection
