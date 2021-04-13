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
                <div class="card-header header-table"><h4>Organismo<h4></div>

                <div class="card-body">

                    <form action="/organismo/save" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre">
                        </div>
                        <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection