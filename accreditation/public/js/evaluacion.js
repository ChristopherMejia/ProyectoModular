
    function crearLabel(texto){
        var nuevaLabel = document.createElement("label");
        labelText = document.createTextNode(texto);
        nuevaLabel.appendChild(labelText);

        return nuevaLabel;
    }
    function crearSelectTipo(idPregunta){
        var nuevoSelectTipo = document.createElement("select");
        nuevoSelectTipo.options[0] = new Option("Cierto o falso",0);
        nuevoSelectTipo.options[1] = new Option("Opción múltiple",1);
        nuevoSelectTipo.options[2] = new Option("Selección múltiple",2);
        nuevoSelectTipo.options[3] = new Option("Abierta",3);
        nuevoSelectTipo.id = "tipo_" + idPregunta;
        nuevoSelectTipo.addEventListener('click',function(){ 
            cambiarTipo(idPregunta)}
        );
        return nuevoSelectTipo;
    }

    function crearCheckEvidencia(idPregunta){
        var nuevoCheckEvidencia = document.createElement("input");
        nuevoCheckEvidencia.type = "checkbox";
        nuevoCheckEvidencia.id = "check_" + idPregunta;
        nuevoCheckEvidencia.addEventListener('click',function(){ 
            habilitarEvidencia(idPregunta)}
        );

        return nuevoCheckEvidencia;
    }

    function crearDescripcionEvidencia(idPregunta){
        var nuevaDescripcionEvidencia = document.createElement("textarea");
        nuevaDescripcionEvidencia.placeholder = "Describir evidencia";
        nuevaDescripcionEvidencia.id = "evidencia_" + idPregunta;
        nuevaDescripcionEvidencia.hidden = true;

        return nuevaDescripcionEvidencia;
    }

    function crearCiertoFalso(idPregunta){
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
        nuevoCiertoFalso.id = "ciertoFalso_" + idPregunta;
        nuevoCiertoFalso.appendChild(nuevoBotonCierto);
        nuevoCiertoFalso.appendChild(ciertoLabel);
        nuevoCiertoFalso.appendChild(nuevoBotonFalso);
        nuevoCiertoFalso.appendChild(falsoLabel);
        
        return nuevoCiertoFalso;
    }

    function crearEspacioRespuesta(idPregunta){
        var nuevoEspacioRespuesta = document.createElement("input");
        nuevoEspacioRespuesta.value = "Respuesta";
        nuevoEspacioRespuesta.id = "res_" + idPregunta;
        nuevoEspacioRespuesta.hidden = true;
        nuevoEspacioRespuesta.disabled = true;

        return nuevoEspacioRespuesta;
    }

    function crearOpcionMultiple(idPregunta){
        var nuevaOpcionRadio = document.createElement("input");
        nuevaOpcionRadio.type = "radio";
        nuevaOpcionRadio.disabled = true;
        var nuevaOpcion = document.createElement("input");
        nuevaOpcion.placeholder = "Opción 1";
        nuevaOpcion.id = "pregunta_"+idPregunta+"_opc_1";
        var nuevasOpciones = document.createElement("div");
        nuevasOpciones.id = "opciones_"+idPregunta;
        nuevasOpciones.appendChild(nuevaOpcionRadio);
        nuevasOpciones.appendChild(nuevaOpcion);

        var nuevoBotonOpcion = document.createElement("button"); 
        botonText1 = document.createTextNode("Añadir opción");
        nuevoBotonOpcion.appendChild(botonText1);
        nuevoBotonOpcion.addEventListener('click',function(){ 
            agregarOpcion(idPregunta)}
        );

        var nuevaOpcionMultiple = document.createElement("div");
        nuevaOpcionMultiple.id = "opcionMultiple_"+idPregunta;
        nuevaOpcionMultiple.hidden = true;
        nuevaOpcionMultiple.appendChild(nuevasOpciones);
        nuevaOpcionMultiple.appendChild(nuevoBotonOpcion);

        return nuevaOpcionMultiple;
    }

    function crearEspacioAdjunto(idPregunta){
        var nuevoEspacioAdjunto = document.createElement("div");
        adjuntoText = document.createTextNode("Adjunto");
        adjuntoLabel = document.createElement("label");
        adjuntoLabel.appendChild(adjuntoText);
        nuevoAdjunto = document.createElement("input");
        nuevoAdjunto.type = "file";
        nuevoEspacioAdjunto.appendChild(adjuntoLabel);
        nuevoEspacioAdjunto.appendChild(nuevoAdjunto);
        nuevoEspacioAdjunto.id = "adjunto_" + idPregunta;

        return nuevoEspacioAdjunto;
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agregarPregunta() {
        // crea un nuevo div
        // y añade contenido
        var idPreguntaActual = $("#preguntas")[0].lastChild.id;
        var idNuevaPregunta = parseInt(idPreguntaActual.split('_')[1]) + 1;

        var nuevaPregunta = document.createElement("div");
        nuevaPregunta.className = "card";
        nuevaPregunta.id = "Pregunta_" + idNuevaPregunta;

        ultimaSubpreguntaId = document.createAttribute("ultimaSubpreguntaId");
        ultimaSubpreguntaId.value=0;
        nuevaPregunta.setAttributeNode(ultimaSubpreguntaId);
        
        var nuevoEncabezadoPregunta = document.createElement("div");
        nuevoEncabezadoPregunta.className = "card-header";

        var nuevoIdentificadorPregunta = crearLabel(idNuevaPregunta + ".")

        var nuevoTituloPregunta = document.createElement("input");
        nuevoTituloPregunta.placeholder = "Pregunta";

        var nuevoSelectTipo = crearSelectTipo(idNuevaPregunta);

        var nuevoCheckEvidencia = crearCheckEvidencia(idNuevaPregunta);

        var checkLabel = crearLabel("Evidencia");

        var nuevaDescripcionEvidencia = crearDescripcionEvidencia(idNuevaPregunta);

        var nuevoEspacioAdjunto = crearEspacioAdjunto(idNuevaPregunta);

        var nuevoCiertoFalso = crearCiertoFalso(idNuevaPregunta);

        var nuevoEspacioRespuesta = crearEspacioRespuesta(idNuevaPregunta);

        var nuevaOpcionMultiple = crearOpcionMultiple(idNuevaPregunta);
        
        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.className = "card-body"

        nuevaPregunta.appendChild(nuevoEncabezadoPregunta); 
        nuevoEncabezadoPregunta.appendChild(nuevoIdentificadorPregunta);
        nuevoEncabezadoPregunta.appendChild(nuevoTituloPregunta);
        nuevoEncabezadoPregunta.appendChild(nuevoSelectTipo);  
        nuevoEncabezadoPregunta.appendChild(nuevoCheckEvidencia); 
        nuevoEncabezadoPregunta.appendChild(checkLabel); 
        nuevoEncabezadoPregunta.appendChild(nuevaDescripcionEvidencia);
        nuevoEncabezadoPregunta.appendChild(nuevoEspacioAdjunto);
        nuevaPregunta.appendChild(nuevoCuerpoPregunta);
        nuevoCuerpoPregunta.appendChild(nuevoCiertoFalso);
        nuevoCuerpoPregunta.appendChild(nuevaOpcionMultiple);
        nuevoCuerpoPregunta.appendChild(nuevoEspacioRespuesta);  
        
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agregarSubPregunta(idPregunta) {
        // crea un nuevo div
        // y añade contenido
        var idNuevaSubPregunta =  ++($("#Pregunta_"+idPregunta)[0].attributes.ultimaSubpreguntaId.value);
        var nuevaSubPregunta = document.createElement("div");
        nuevaSubPregunta.className = "card";
        nuevaSubPregunta.id = "SubPregunta_" + idNuevaSubPregunta;

        var nuevoEncabezadoPregunta = document.createElement("div");
        nuevoEncabezadoPregunta.className = "card-header"

        var nuevoIdentificadorPregunta = document.createElement("label");
        identificadorText = document.createTextNode( idPregunta + "." + idNuevaSubPregunta + ".");
        nuevoIdentificadorPregunta.appendChild(identificadorText);

        var nuevoTituloPregunta = document.createElement("input");
        nuevoTituloPregunta.placeholder = "Subpregunta"

        var nuevoSelectTipo = crearSelectTipo(idPregunta + "-" + idNuevaSubPregunta);

        var nuevoCheckEvidencia = crearCheckEvidencia(idPregunta + "-" + idNuevaSubPregunta);

        var checkLabel = crearLabel("Evidencia");

        var nuevaDescripcionEvidencia = crearDescripcionEvidencia(idPregunta + "-" + idNuevaSubPregunta);

        var nuevoCiertoFalso = crearCiertoFalso(idPregunta + "-" + idNuevaSubPregunta);

        var nuevoEspacioRespuesta = crearEspacioRespuesta(idPregunta + "-" + idNuevaSubPregunta);

        var nuevaOpcionMultiple = crearOpcionMultiple(idPregunta + "-" + idNuevaSubPregunta);

        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.className = "card-body"

        nuevaSubPregunta.appendChild(nuevoEncabezadoPregunta); 
        nuevoEncabezadoPregunta.appendChild(nuevoIdentificadorPregunta);
        nuevoEncabezadoPregunta.appendChild(nuevoTituloPregunta); //añade texto al div creado.
        nuevoEncabezadoPregunta.appendChild(nuevoSelectTipo);  
        nuevoEncabezadoPregunta.appendChild(nuevoCheckEvidencia);
        nuevoEncabezadoPregunta.appendChild(checkLabel);
        nuevoEncabezadoPregunta.appendChild(nuevaDescripcionEvidencia);
        nuevaSubPregunta.appendChild(nuevoCuerpoPregunta);
        nuevoCuerpoPregunta.appendChild(nuevoCiertoFalso);
        nuevoCuerpoPregunta.appendChild(nuevaOpcionMultiple);
        nuevoCuerpoPregunta.appendChild(nuevoEspacioRespuesta);  
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

