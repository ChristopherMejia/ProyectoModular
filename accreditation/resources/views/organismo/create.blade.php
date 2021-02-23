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
    <form action="/organismo/save" method="POST">
        @csrf
        <div class="form-group">
            <label for="name"> <h2>Nombre Organismo</h2> </label>
            <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection