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

    <div class="card-header header-table"><h4> Organismos <h4></div>

    <div class="col-12" align="right">
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#crearOrganismo" style="margin-right: 16px ;margin-top: 13px;">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-header border-bottom">
                <h3 class="h4 mb-0">Información de Organismos</h3>
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
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOrganismo" href="#" onclick="editOrganismo({{$organismo->id}})">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#deleteOrganismo" href="#" onclick="deleteOrganismo({{$organismo->id}})">
                            <i class="fas fa-user-times"></i>
                        </a>
                        </td>
                        </tr>
                        @endforeach
                        {{ $organismos->links() }}
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>




</div>

@endsection
