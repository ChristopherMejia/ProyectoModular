<script>
    function agregarPregunta() {
    // crea un nuevo div
    // y añade contenido
    var nuevaPregunta = document.createElement("div");
    nuevaPregunta.className = "card";
    var nuevoEncabezadoPregunta = document.createElement("div");
    nuevoEncabezadoPregunta.className = "card-header"
    var nuevoTituloPregunta = document.createElement("input");
    nuevoTituloPregunta.value = "Pregunta"
    var nuevoSelectTipo = document.createElement("select");
    nuevoSelectTipo.className = "selectpicker";
    nuevoSelectTipo.options[0] = new Option("Opción múltiple");
    nuevoSelectTipo.options[1] = new Option("Selección múltiple");
    nuevoSelectTipo.options[2] = new Option("Subir archivo");
    nuevoSelectTipo.options[3] = new Option("Abierta");
    var nuevaDescripcionPregunta = document.createElement("input");
    nuevaDescripcionPregunta.value = "Descripción"
    var nuevoCuerpoPregunta = document.createElement("div");
    nuevoCuerpoPregunta.className = "card-body"
    nuevaPregunta.appendChild(nuevoEncabezadoPregunta); 
    nuevoEncabezadoPregunta.appendChild(nuevoTituloPregunta); //añade texto al div creado.
    nuevaPregunta.appendChild(nuevoCuerpoPregunta);
    nuevoCuerpoPregunta.appendChild(nuevaDescripcionPregunta);  
    nuevoCuerpoPregunta.appendChild(nuevoSelectTipo);   
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

