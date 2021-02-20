@extends('layouts.app')
@section('content')
<div class="main-container">

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        @foreach($Organismos as $organismo)
        <tbody>
            <tr>
                <td id="organismoId" scope="row">{{$organismo->id}}</td>
                <td id="organismoNombre"scope="row">{{$organismo->nombre}}</td>
                <td>
                <button id ="edit-item" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                    <span class="material-icons">mode_edit</span>
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <span class="material-icons">delete_outline</span>
                </button>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="form-group">
              <label for="modal-input-name">Nombre</label>
              <input type="text" class="form-control" id="modal-input-name" name="organismoName" required>
              <input type="hidden" id="modal-input-id" name="organismo_id">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
           
</div>
@endsection