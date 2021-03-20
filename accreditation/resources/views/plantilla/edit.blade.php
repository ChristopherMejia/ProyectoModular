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
        nuevoSelectTipo.options[0] = new Option("Opción múltiple",0);
        nuevoSelectTipo.options[1] = new Option("Selección múltiple",1);
        nuevoSelectTipo.options[2] = new Option("Subir archivo",2);
        nuevoSelectTipo.options[3] = new Option("Abierta",3);

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
        nuevoTituloPregunta.value = "Subpregunta"

        var nuevoSelectTipo = document.createElement("select");
        nuevoSelectTipo.options[0] = new Option("Opción múltiple",0);
        nuevoSelectTipo.options[1] = new Option("Selección múltiple",1);
        nuevoSelectTipo.options[2] = new Option("Subir archivo",2);
        nuevoSelectTipo.options[3] = new Option("Abierta",3);

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

    function habilitarEvidencia(idPregunta){
        if($("#check_"+idPregunta)[0].checked){
            $("#evidencia_"+idPregunta)[0].hidden = false;
        }
        else{
            $("#evidencia_"+idPregunta)[0].hidden = true;
        }
    }

    function agregarOpcion(idPregunta){
        var nuevaOpcionRadio = document.createElement("input");
        nuevaOpcionRadio.type = "radio";
        nuevaOpcionRadio.disabled=true;
        var idOpcionActual = $("#opciones_"+idPregunta)[0].lastChild.id;
        var idNuevaOpcion =  parseInt(idOpcionActual.split('_')[3]) + 1;
        var nuevaOpcion= document.createElement("input");
        nuevaOpcion.placeholder = "Opción " + idNuevaOpcion;
        nuevaOpcion.id = "pregunta_"+idPregunta+"_opc_"+idNuevaOpcion;
        $("#opciones_"+idPregunta)[0].appendChild(nuevaOpcionRadio);
        $("#opciones_"+idPregunta)[0].appendChild(nuevaOpcion);
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
                    <label>Pregunta</label>
                    <input type="text" placeholder="Pregunta"></input>
                    <select value="Pregunta">
                    <option value="0">Opción múltiple</option>
                    <option value="1">Selección múltiple</option>
                    <option value="2">Abierta</option>
                    </select>
                    <input id=check_1 type="checkbox" onChange="habilitarEvidencia(1)">Evidencia</input>
                    <textarea id=evidencia_1 placeholder="Describir evidencia" hidden></textarea>
                </div>
                <div class="card-body">
                    <div id="opcionMultiple_1">
                        <div id="opciones_1">
                            <input type="radio" disabled></input>
                            <input id=pregunta_1_opc_1 type=text placeholder="Opción 1"></input>
                        </div>
                        <button id="+opc_1" onClick="agregarOpcion(1)">Añadir opción</button>
                    </div>
                    <input type="text" value="Respuesta" disabled></input>
                </div>
                <button id="Boton_1" onClick="agregarSubPregunta(1)">Agregar subpregunta</button>
            </div>
         </div>   
         <button id="buttonAgregar" onClick="agregarPregunta()">Agregar</button> 
    </div>
</div>
@endsection

