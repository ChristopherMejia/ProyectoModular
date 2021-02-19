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
        <div class="card">
            <label for="Organismo">Organismo</label>
            <select name="Organismo" class="selectpicker">
            @foreach($organismos as $orgs)
						<option value="{{$orgs->nombre}}">{{$orgs->nombre}}</option>
			@endforeach
            </select>
            <label for="Version">Versión</label>
            <input type="text" name="Version">
            </input>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection