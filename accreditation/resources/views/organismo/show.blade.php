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
                <td scope="row">{{$organismo->id}}</td>
                <td scope="row">{{$organismo->nombre}}</td>
                <td>
                <button type="button" data-toggle="modal" id ="edit-item"><span class="material-icons">mode_edit</span></a>
                <button type="button" data-toggle="modal" id="delete-item"><span class="material-icons">delete_outline</span></a>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
           
</div>
@endsection