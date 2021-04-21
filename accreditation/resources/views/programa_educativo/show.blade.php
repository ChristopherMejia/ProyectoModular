@extends('layouts.app')
@section('content')

<div class="main-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
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
                <div class="card-header header-table"><h4>Programa Educativo<h4></div>
                <div class="card-body">
                    <table id="table" class="table table-hover table-sm" style="text-align: center;">
                        <thead>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Nivel</th>
                            <th colspan=2>Acciones</th>
                        </thead>
                        <tbody>
                        @foreach($Programas as $programa)
                            <tr>
                                <td id="id_item" data-id="{{$programa->id}}">{{$programa->id}}</td>
                                <td id="name_item" data-name="{{$programa->nombre}}">{{$programa->nombre}}</td>
                                <td>{{$programa->nivel}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" 
                                            data-bs-toggle="modal" data-bs-target="#edit-item" id="btnEdit"    
                                    >
                                        <span class="material-icons" data-id="{{$programa->id}}" data-name="{{$programa->nombre}}">mode_edit</span>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            data-bs-toggle="modal" data-bs-target="#delete-item" id="btnDelete"
                                    >
                                        <span class="material-icons" data-id="{{$programa->id}}" data-name="{{$programa->nombre}}">delete_outline</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$Programas->links()}}
                
                </div>
            </div>
        </div>

     <!-- Modal Edit -->
     <div class="modal fade" id="edit-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Programa Educativo</h5>
                </div>
                
                <div class="modal-body">
                <input id="itemToEdit"type="text" class="form-control" disabled>

                <form action="/programa-educativo/edit" method="post">
                    @csrf
                    <div class="form-group">

                        <select class="form-select" aria-label="Default select example" id="nivel" name="nivel" style="margin-bottom: 25px; margin-top: 25px;">
                            <option value="null" hidden>Nivel</option>
                            <option value="Educación Inicial">Educación Inicial</option>
                            <option value="Educación Basica">Educación Básica</option>
                            <option value="Educación Media Superior">Educación Media Superior</option>
                            <option value="Educación Superior">Educación Superior</option>
                            <option value="Educación Tecnologica">Educación Tecnologica</option>
                        </select>

                        <label class="form-label">Programa Educativo</label>
                        <input class="form-control" type="text" name="educacion" id="nombre" placeholder="Nombre">
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
            <h5 class="modal-title" id="staticBackdropLabel">Borrar Programa Educativo</h5>
            </div>
            <div class="modal-body">
            <form action="/programa-educativo/delete" method="post">
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
</div>
<script type="application/javascript" src="{{ asset('js/educacion.js') }}"></script>
@endsection