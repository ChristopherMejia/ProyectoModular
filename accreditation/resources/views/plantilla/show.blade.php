@extends('layouts.app')
@section('content')

<div class="main-container">
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Organismo</th>
            <th scope="col">Version</th>
            <th scope="col">Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($plantillas as $plantilla)
        <tr>
            <td>{{ $plantilla->nombre}}</td>
            <td>{{ $plantilla->version}}</td>
            <td><button type="button" class="btn btn-warning btn-sm">Comenzar</button></td>
        </tr>
        @endforeach
    </tbody>
   
</table>
{{ $plantillas->links() }}
</div>

@endsection
