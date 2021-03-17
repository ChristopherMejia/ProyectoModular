<script>
    function agregarPregunta() {
    // crea un nuevo div
    // y añade contenido
    var nuevaPregunta = document.createElement("div");
    nuevaPregunta.className = "card";
    var nuevoEncabezadoPregunta = document.createElement("div");
    nuevoEncabezadoPregunta.className = "card-header"
    var nuevoTituloPregunta = document.createTextNode("Pregunta");
    nuevaPregunta.appendChild(nuevoEncabezadoPregunta); 
    nuevoEncabezadoPregunta.appendChild(nuevoTituloPregunta); //añade texto al div creado.

    // añade el elemento creado y su contenido al DOM
    var buttonAgregar = document.getElementById("buttonAgregar");
    $("#preguntas")[0].insertBefore(nuevaPregunta, buttonAgregar);
    }
</script>

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="preguntas" class="col-md-8">
            <div class="card">
                <div class="card-header">Plantilla {{$plantilla->organismo}} {{$plantilla->version}}</div>
            </div>
            <div id="pregunta1" class="card">
                <div class="card-header"><input type="text" value="Pregunta 1"></input></div>
                <div class="card-body">
                <input type="text" value="Descripción"></input>
                </div>
            </div>
            <button id="buttonAgregar" onClick="agregarPregunta()">Agregar</button> 
         </div>   
    </div>
</div>
@endsection

