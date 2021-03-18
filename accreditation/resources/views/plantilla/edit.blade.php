<script>
    function agregarPregunta() {
        // crea un nuevo div
        // y añade contenido
        var idPreguntaActual = $("#preguntas")[0].lastChild.id;
        var idNuevaPregunta = parseInt(idPreguntaActual.split('_')[1]) + 1;

        var nuevaPregunta = document.createElement("div");
        nuevaPregunta.className = "card";
        nuevaPregunta.id = "Pregunta_" + idNuevaPregunta;

        var nuevoEncabezadoPregunta = document.createElement("div");
        nuevoEncabezadoPregunta.className = "card-header"

        var nuevoTituloPregunta = document.createElement("input");
        nuevoTituloPregunta.value = "Pregunta"

        var nuevoSelectTipo = document.createElement("select");
        nuevoSelectTipo.options[0] = new Option("Opción múltiple");
        nuevoSelectTipo.options[1] = new Option("Selección múltiple");
        nuevoSelectTipo.options[2] = new Option("Subir archivo");
        nuevoSelectTipo.options[3] = new Option("Abierta");

        var nuevaEspacioRespuesta = document.createElement("input");
        nuevaEspacioRespuesta.value = "Respuesta"
        nuevaEspacioRespuesta.disabled = true;

        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.className = "card-body"

        nuevaPregunta.appendChild(nuevoEncabezadoPregunta); 
        nuevoEncabezadoPregunta.appendChild(nuevoTituloPregunta); //añade texto al div creado.
        nuevoEncabezadoPregunta.appendChild(nuevoSelectTipo);  
        nuevaPregunta.appendChild(nuevoCuerpoPregunta);
        nuevoCuerpoPregunta.appendChild(nuevaEspacioRespuesta);  
        
        // añade el elemento creado y su contenido al DOM
        var buttonAgregar = document.getElementById("buttonAgregar");
        $("#preguntas")[0].appendChild(nuevaPregunta);
        //crear boton de subpregunta
        var nuevoBotonSubpregunta = document.createElement("button");
        botonText = document.createTextNode("Agregar subpregunta");
        nuevoBotonSubpregunta.appendChild(botonText);
        nuevoBotonSubpregunta.addEventListener('click',function(){ 
            agregarSubPregunta(idNuevaPregunta)}
        );
        nuevoBotonSubpregunta.id = "Boton_" + idNuevaPregunta;
        nuevaPregunta.appendChild(nuevoBotonSubpregunta);  
    }

    function agregarSubPregunta(idPregunta) {
        // crea un nuevo div
        // y añade contenido
        var idSubPreguntaActual = $("#Pregunta_"+idPregunta)[0].lastChild.id
        var idNuevaSubPregunta =  parseInt(idSubPreguntaActual.split('_')[1]) + 1;
        var nuevaSubPregunta = document.createElement("div");
        nuevaSubPregunta.className = "card";
        nuevaSubPregunta.id = "SubPregunta_" + idNuevaSubPregunta;

        var nuevoEncabezadoPregunta = document.createElement("div");
        nuevoEncabezadoPregunta.className = "card-header"

        var nuevoTituloPregunta = document.createElement("input");
        nuevoTituloPregunta.value = "Pregunta"

        var nuevoSelectTipo = document.createElement("select");
        nuevoSelectTipo.options[0] = new Option("Opción múltiple");
        nuevoSelectTipo.options[1] = new Option("Selección múltiple");
        nuevoSelectTipo.options[2] = new Option("Subir archivo");
        nuevoSelectTipo.options[3] = new Option("Abierta");

        var nuevaEspacioRespuesta = document.createElement("input");
        nuevaEspacioRespuesta.value = "Respuesta"
        nuevaEspacioRespuesta.disabled = true;

        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.className = "card-body"

        nuevaSubPregunta.appendChild(nuevoEncabezadoPregunta); 
        nuevoEncabezadoPregunta.appendChild(nuevoTituloPregunta); //añade texto al div creado.
        nuevoEncabezadoPregunta.appendChild(nuevoSelectTipo);  
        nuevaSubPregunta.appendChild(nuevoCuerpoPregunta);
        nuevoCuerpoPregunta.appendChild(nuevaEspacioRespuesta);  
        // añade el elemento creado y su contenido al DOM
        var buttonAgregar = document.getElementById("Boton_" + idPregunta);
        $("#Pregunta_"+idPregunta)[0].insertBefore(nuevaSubPregunta,buttonAgregar);
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
            <div id="Pregunta_1" class="card">
                <div class="card-header">
                    <input type="text" value="Pregunta"></input>
                    <select value="Pregunta">
                    <option>Opción múltiple</option>
                    <option>Selección múltiple</option>
                    <option>Subir archivo</option>
                    <option>Abierta</option>
                    </select>
                </div>
                <div class="card-body">
                    <input type="text" value="Respuesta" disabled></input>
                </div>
            </div>
         </div>   
         <button id="buttonAgregar" onClick="agregarPregunta()">Agregar</button> 
    </div>
</div>
@endsection

