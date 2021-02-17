@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <label for="Organismo">Organismo</label>
            <select name="Organismo" class="selectpicker">
            @foreach($organismos as $orgs)
						<option value="{{$orgs->nombre}}">{{$orgs->nombre}}</option>
			@endforeach
            </select>
            <label for="Organismo">Versión</label>
            <input type="text" name="Version">
            </input>
            <button type="button" id="bt_crear" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </div>
</div>
@endsection