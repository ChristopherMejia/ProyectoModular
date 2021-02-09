@extends('layouts.app')
@section('content')
<<<<<<< HEAD
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a href="create"><button>Crear nueva plantilla</button></a>
            <div class="card">
                <div class="card-header">Plantillas</div>
                <div class="card-body">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Organismo</th>
                        <th>Versión</th>
                        <th colspan=2>Acciones</th>
                    </thead>
                        @foreach($plantillas as $plantilla)
                                <tr>
                                    <td>{{$plantilla->organismo}}</td>
                                    <td>{{$plantilla->version}}</td>
                                    <td><button>Modificar</button></td>
                                    <td><button>Eliminar</button></td>
                                </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
=======

<div class="container-home">
    <div class="home-header">Organismos</div>
    <table class="table table-hover">
        <thead class="table-dark">
            <th>Id</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </thead>
        @foreach ($Organismos as $organismo)
            <tr>
                <td id='id-organismo'>{{$organismo->id}}</td>
                <td id='name-organismo'>{{$organismo->nombre}}</td>
                <td>
                    <a class=" btn btn-outline-primary" href="/home/{{$organismo->id}}/edit">Edit</a>
                    <a class="btn btn-outline-danger" href="/home/{{$organismo->id}}/confirmDelete">Delete</a>
                </td>
            </tr>
        @endforeach

    </table>

>>>>>>> 6e0fec52ac542e05e9cfb77d6473f50d2ba0beaf
</div>

@endsection
