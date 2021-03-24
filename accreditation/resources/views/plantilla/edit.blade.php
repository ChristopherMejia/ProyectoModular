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
        nuevoTituloPregunta.placeholder = "Pregunta";

        var nuevoSelectTipo = document.createElement("select");
        nuevoSelectTipo.options[0] = new Option("Cierto o falso",0);
        nuevoSelectTipo.options[1] = new Option("Opción múltiple",1);
        nuevoSelectTipo.options[2] = new Option("Selección múltiple",2);
        nuevoSelectTipo.options[3] = new Option("Abierta",3);
        nuevoSelectTipo.id = "tipo_" + idNuevaPregunta;
        nuevoSelectTipo.addEventListener('click',function(){ 
            cambiarTipo(idNuevaPregunta)}
        );

        var nuevoCheckEvidencia = document.createElement("input");
        nuevoCheckEvidencia.type = "checkbox";
        checkText = document.createTextNode("Evidencia");
        checkLabel = document.createElement("label");
        checkLabel.appendChild(checkText);

        adjuntoText = document.createTextNode("Adjunto");
        adjuntoLabel = document.createElement("label");
        adjuntoLabel.appendChild(adjuntoText);

        var nuevoBotonCierto  = document.createElement("input");
        nuevoBotonCierto.type = "radio";
        nuevoBotonCierto.disabled = true;
        var ciertoText = document.createTextNode("Cierto");
        var ciertoLabel = document.createElement("label");
        ciertoLabel.appendChild(ciertoText);
        var nuevoBotonFalso  = document.createElement("input");
        nuevoBotonFalso.disabled = true;
        var falsoText = document.createTextNode("Falso");
        var falsoLabel = document.createElement("label");
        falsoLabel.appendChild(falsoText);
        nuevoBotonFalso.type = "radio";
        nuevoBotonFalso.disabled = true;
        var nuevoCiertoFalso  = document.createElement("div");
        nuevoCiertoFalso.id = "ciertoFalso_" + idNuevaPregunta;
        nuevoCiertoFalso.appendChild(nuevoBotonCierto);
        nuevoCiertoFalso.appendChild(ciertoLabel);
        nuevoCiertoFalso.appendChild(nuevoBotonFalso);
        nuevoCiertoFalso.appendChild(falsoLabel);


        var nuevaEspacioRespuesta = document.createElement("input");
        nuevaEspacioRespuesta.value = "Respuesta";
        nuevaEspacioRespuesta.id = "res_" + idNuevaPregunta;
        nuevaEspacioRespuesta.hidden = true;
        nuevaEspacioRespuesta.disabled = true;

        var nuevaOpcionRadio = document.createElement("input");
        nuevaOpcionRadio.type = "radio";
        nuevaOpcionRadio.disabled = true;
        var nuevaOpcion = document.createElement("input");
        nuevaOpcion.placeholder = "Opción 1";
        nuevaOpcion.id = "pregunta_"+idNuevaPregunta+"_opc_1";
        var nuevasOpciones = document.createElement("div");
        nuevasOpciones.id = "opciones_"+idNuevaPregunta;
        nuevasOpciones.appendChild(nuevaOpcionRadio);
        nuevasOpciones.appendChild(nuevaOpcion);

        var nuevoBotonOpcion = document.createElement("button"); 
        botonText1 = document.createTextNode("Añadir opción");
        nuevoBotonOpcion.appendChild(botonText1);
        nuevoBotonOpcion.addEventListener('click',function(){ 
            agregarOpcion(idNuevaPregunta)}
        );

        var nuevaOpcionMultiple = document.createElement("div");
        nuevaOpcionMultiple.id = "opcionMultiple_"+idNuevaPregunta;
        nuevaOpcionMultiple.hidden = true;
        nuevaOpcionMultiple.appendChild(nuevasOpciones);
        nuevaOpcionMultiple.appendChild(nuevoBotonOpcion);

        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.className = "card-body"

        nuevaPregunta.appendChild(nuevoEncabezadoPregunta); 
        nuevoEncabezadoPregunta.appendChild(nuevoTituloPregunta); //añade texto al div creado.
        nuevoEncabezadoPregunta.appendChild(nuevoSelectTipo);  
        nuevoEncabezadoPregunta.appendChild(nuevoCheckEvidencia); 
        nuevoEncabezadoPregunta.appendChild(checkLabel); 
        nuevaPregunta.appendChild(nuevoCuerpoPregunta);
        nuevoCuerpoPregunta.appendChild(nuevoCiertoFalso);
        nuevoCuerpoPregunta.appendChild(nuevaOpcionMultiple);
        nuevoCuerpoPregunta.appendChild(nuevaEspacioRespuesta);  
        
        // añade el elemento creado y su contenido al DOM
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
        nuevoSelectTipo.options[0] = new Option("Cierto o falso",0);
        nuevoSelectTipo.options[1] = new Option("Opción múltiple",1);
        nuevoSelectTipo.options[2] = new Option("Selección múltiple",2);
        nuevoSelectTipo.options[3] = new Option("Abierta",3);

        var nuevaEspacioRespuesta = document.createElement("input");
        nuevaEspacioRespuesta.value = "Respuesta";
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
        var idOpcionActual = $("#opciones_"+idPregunta)[0].lastChild.id;
        var idNuevaOpcion =  parseInt(idOpcionActual.split('_')[3]) + 1;
        var nuevaOpcion= document.createElement("input");
        var nuevoBotonEliminar = document.createElement("button");
        botonText = document.createTextNode("X");
        nuevoBotonEliminar.appendChild(botonText);
        nuevoBotonEliminar.addEventListener('click',function(){ 
            eliminarOpcion(idPregunta,idNuevaOpcion)
            this.remove();
            }
        );
        nuevaOpcion.placeholder = "Opción " + idNuevaOpcion;
        nuevaOpcion.id = "pregunta_"+idPregunta+"_opc_"+idNuevaOpcion;
        
        $("#opciones_"+idPregunta)[0].appendChild(nuevoBotonEliminar);
        $("#opciones_"+idPregunta)[0].appendChild(nuevaOpcion);
    }

    function eliminarOpcion(idPregunta,idOpcion){
        $('#pregunta_'+idPregunta+'_opc_'+idOpcion).remove();
    }

    function cambiarTipo(idPregunta){
        var tipo = $("#tipo_"+idPregunta+" option:selected")[0].value;
        switch(tipo){
            case "0":
                $("#ciertoFalso_"+idPregunta)[0].hidden = false;
                $("#res_"+idPregunta)[0].hidden = true;
                $("#opcionMultiple_"+idPregunta)[0].hidden = true;
                break;
            case "1":
                $("#ciertoFalso_"+idPregunta)[0].hidden = true;
                $("#res_"+idPregunta)[0].hidden = true;
                $("#opcionMultiple_"+idPregunta)[0].hidden = false;
                break;
            case "2":
                $("#ciertoFalso_"+idPregunta)[0].hidden = true;
                $("#res_"+idPregunta)[0].hidden = true;
                $("#opcionMultiple_"+idPregunta)[0].hidden = false;
                break;
            case "3":
                $("#ciertoFalso_"+idPregunta)[0].hidden = true;
                $("#res_"+idPregunta)[0].hidden = false;
                $("#opcionMultiple_"+idPregunta)[0].hidden = true;
                break;
            default:
                break;
        }
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
                    <select id="tipo_1" value="Pregunta" onChange="cambiarTipo(1)">
                        <option value="0">Cierto o falso</option>
                        <option value="1">Opción múltiple</option>
                        <option value="2">Selección múltiple</option>
                        <option value="3">Abierta</option>
                    </select>
                    <input id=check_1 type="checkbox" onChange="habilitarEvidencia(1)">Evidencia</input>
                    <textarea id=evidencia_1 placeholder="Describir evidencia" hidden></textarea>
                    <div id="adjunto_1">
                        <label>Adjunto</label>
                        <input type="file" id="file_1"></input>
                    </div>
                </div>
                <div class="card-body">
                    <div id="ciertoFalso_1">
                        <input type="radio" disabled></input>
                        <label>Cierto</label>
                        <input type="radio" disabled></input>
                        <label>Falso</label>
                    </div>
                    <div id="opcionMultiple_1" hidden=true>
                        <div id="opciones_1">
                            <input type="radio" disabled></input>
                            <input id=pregunta_1_opc_1 type=text placeholder="Opción 1"></input>
                        </div>
                        <button id="+opc_1" onClick="agregarOpcion(1)">Añadir opción</button>
                    </div>
                    <input id="res_1" type="text" value="Respuesta" disabled hidden=true></input>
                </div>
                <button id="Boton_1" onClick="agregarSubPregunta(1)">Agregar subpregunta</button>
            </div>
         </div>   
         <button id="buttonAgregar" onClick="agregarPregunta()">Agregar</button> 
    </div>
</div>
@endsection

