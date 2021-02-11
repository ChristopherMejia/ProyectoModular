@extends('layouts.app')
@section('content')

<!-- <div class="container-home">
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
</div> -->

@endsection
