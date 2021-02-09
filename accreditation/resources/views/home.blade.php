@extends('layouts.app')
@section('content')
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
</div>
@endsection
