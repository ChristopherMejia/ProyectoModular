
    function crearLabel(texto){
        var nuevaLabel = document.createElement("label");
        labelText = document.createTextNode(texto);
        nuevaLabel.appendChild(labelText);
        return nuevaLabel;
    }

    /**
     * Crea un select de tipo para una pregunta
     * @param {number} idCategoria
     * @param {number} idSubcategoria
     * @param {string} idPregunta
     * @returns HTMLSelectElement
     */
    function crearSelectTipo(idCategoria,idSubcategoria,idPregunta){
        var i = idCategoria - 1;
        var j = idSubcategoria -1;
        var nuevoSelectTipo = document.createElement("select");
        nuevoSelectTipo.className = "form-select";
        nuevoSelectTipo.options[0] = new Option("Cierto o falso",0);
        nuevoSelectTipo.options[1] = new Option("Opción múltiple",1);
        /* nuevoSelectTipo.options[2] = new Option("Selección múltiple",2); */
        nuevoSelectTipo.options[2] = new Option("Abierta",3);
        nuevoSelectTipo.options[3] = new Option("Subpreguntas",4);
        nuevoSelectTipo.id = "tipo_" + idPregunta;
        nuevoSelectTipo.name = "tipos["+i+"]["+j+"][]";
        nuevoSelectTipo.addEventListener('click',function(){
            cambiarTipo(idPregunta,false)}
        );
        return nuevoSelectTipo;
    }

    /**
     * Crear un select de tipo para una subpregunta
     * @param {number} idCategoria
     * @param {number} idSubcategoria
     * @param {number} idPregunta
     * @param {string} idSubpregunta
     * @returns HTMLSelectElement
     */
    function crearSelectTipoSub(idCategoria,idSubcategoria,idPregunta,idSubpregunta){
        var i = idCategoria - 1;
        var j = idSubcategoria -1;
        var k = idPregunta -1;
        var nuevoSelectTipo = document.createElement("select");
        nuevoSelectTipo.className = "form-select";
        nuevoSelectTipo.options[0] = new Option("Cierto o falso",0);
        nuevoSelectTipo.options[1] = new Option("Opción múltiple",1);
        /* nuevoSelectTipo.options[2] = new Option("Selección múltiple",2); */
        nuevoSelectTipo.options[2] = new Option("Abierta",3);
        nuevoSelectTipo.id = "tipo_" + idSubpregunta;
        nuevoSelectTipo.name = "tipos_sub["+i+"]["+j+"]["+k+"][]";
        nuevoSelectTipo.addEventListener('click',function(){
            cambiarTipo(idSubpregunta,true)}
        );
        return nuevoSelectTipo;
    }

    /**
     * Crear un checkbox para indicar si la pregunta o subpregunta tendrá evidencia
     * @param {string} idPregunta
     * @returns HTMLInputElement
     */
    function crearCheckEvidencia(idPregunta){
        var nuevoCheckEvidencia = document.createElement("input");
        nuevoCheckEvidencia.className = "form-check-input";
        nuevoCheckEvidencia.type = "checkbox";
        nuevoCheckEvidencia.id = "check_" + idPregunta;
        nuevoCheckEvidencia.addEventListener('click',function(){
            habilitarEvidencia(idPregunta)}
        );

        return nuevoCheckEvidencia;
    }

    /**
     * Crear un espacio para escribir la descripción de la evidencia
     * @param {number} idCategoria
     * @param {number} idSubcategoria
     * @param {string} idPregunta
     * @returns HTMLTextAreaElement
     */
    function crearDescripcionEvidencia(idCategoria,idSubcategoria,idPregunta){
        var i = idCategoria - 1;
        var j = idSubcategoria -1;
        var nuevaDescripcionEvidencia = document.createElement("textarea");
        nuevaDescripcionEvidencia.className = "form-control";
        nuevaDescripcionEvidencia.cols = "80";
        nuevaDescripcionEvidencia.placeholder = "Agregar Descripción de evidencia";
        nuevaDescripcionEvidencia.id = "evidencia_" + idPregunta;
        nuevaDescripcionEvidencia.name = "evidencias["+i+"]["+j+"][]";
        nuevaDescripcionEvidencia.hidden = true;

        return nuevaDescripcionEvidencia;
    }

    /**
     * Crear un espacio para escribir la descripción de la evidencia
     * @param {number} idCategoria
     * @param {number} idSubcategoria
     * @param {number} idPregunta
     * @param {string} idSubpregunta
     * @returns HTMLTextAreaElement
     */
    function crearDescripcionEvidenciaSub(idCategoria,idSubcategoria,idPregunta,idSubpregunta){
        var i = idCategoria - 1;
        var j = idSubcategoria -1;
        var k = idPregunta -1;
        var nuevaDescripcionEvidencia = document.createElement("textarea");
        nuevaDescripcionEvidencia.className="form-control";
        nuevaDescripcionEvidencia.cols="80";
        nuevaDescripcionEvidencia.placeholder = "Agregar Descripción de evidencia";
        nuevaDescripcionEvidencia.id = "evidencia_" + idSubpregunta;
        nuevaDescripcionEvidencia.name = "evidencias["+i+"]["+j+"]["+k+"][]";
        nuevaDescripcionEvidencia.hidden = true;

        return nuevaDescripcionEvidencia;
    }

    function crearCiertoFalso(idPregunta){

        var divPadreCierto = document.createElement("div");
        var nuevoBotonCierto  = document.createElement("input");
        nuevoBotonCierto.type = "radio";
        nuevoBotonCierto.disabled = true;
        nuevoBotonCierto.className = "form-check-input";
        var ciertoText = document.createTextNode("Cierto");
        var ciertoLabel = document.createElement("label");
        ciertoLabel.className = "form-check-label";
        ciertoLabel.appendChild(ciertoText);

        divPadreCierto.appendChild(nuevoBotonCierto);
        divPadreCierto.appendChild(ciertoLabel);

        var divPadreFalso = document.createElement("div");
        var nuevoBotonFalso  = document.createElement("input");
        nuevoBotonFalso.type = "radio";
        nuevoBotonFalso.disabled = true;
        nuevoBotonFalso.className = "form-check-input";
        var falsoText = document.createTextNode("Falso");
        var falsoLabel = document.createElement("label");
        falsoLabel.className = "form-check-label";
        falsoLabel.appendChild(falsoText);

        divPadreFalso.appendChild(nuevoBotonFalso);
        divPadreFalso.appendChild(falsoLabel);

        var nuevoCiertoFalso  = document.createElement("div");
        nuevoCiertoFalso.id = "ciertoFalso_" + idPregunta;

        nuevoCiertoFalso.appendChild(divPadreCierto);
        nuevoCiertoFalso.appendChild(divPadreFalso);

        return nuevoCiertoFalso;
    }

    function crearEspacioRespuesta(idPregunta){
        var nuevoEspacioRespuesta = document.createElement("input");
        nuevoEspacioRespuesta.className = "form-control col-6";
        nuevoEspacioRespuesta.value = "Respuesta";
        nuevoEspacioRespuesta.id = "res_" + idPregunta;
        nuevoEspacioRespuesta.hidden = true;
        nuevoEspacioRespuesta.disabled = true;

        return nuevoEspacioRespuesta;
    }

    function crearOpcionMultiple(idPregunta,arrayOpciones, esSubpregunta){
        var divPadreOpciones = document.createElement("div");
        divPadreOpciones.style = "margin-bottom: 10px;";
        divPadreOpciones.id = idPregunta + "_opc-1";

        var nuevaOpcionRadio = document.createElement("input");
        nuevaOpcionRadio.className = "form-check-input";
        nuevaOpcionRadio.type = "radio";
        nuevaOpcionRadio.disabled = true;

        var nuevaOpcion = document.createElement("input");
        nuevaOpcion.className = "form-control col-3";
        nuevaOpcion.placeholder = "Opción 1";
        
        if(esSubpregunta){
            nuevaOpcion.name = "subopciones"+arrayOpciones;
        }
        else{
            nuevaOpcion.name = "opciones"+arrayOpciones;
        }


        divPadreOpciones.appendChild(nuevaOpcionRadio);
        divPadreOpciones.appendChild(nuevaOpcion);


        var nuevasOpciones = document.createElement("div");
        nuevasOpciones.style = "margin-bottom: 10px;";
        nuevasOpciones.id = "opciones_" + idPregunta;
        nuevasOpciones.opciones = arrayOpciones;
        nuevasOpciones.appendChild(divPadreOpciones);

        var iconAdd = document.createElement("i");
        iconAdd.className = "fa fa-plus";
        iconAdd.ariaHidden = "true";
        iconAdd.title = "Agregar opción";

        var nuevoBotonOpcion = document.createElement("button");
        botonText1 = document.createTextNode(" Opción");
        nuevoBotonOpcion.appendChild(iconAdd);
        nuevoBotonOpcion.appendChild(botonText1);
        nuevoBotonOpcion.type = "button"; //se debe especificar que el boton es de tipo button o si no el default será tipo submit
        nuevoBotonOpcion.className = "btn btn-primary";
        nuevoBotonOpcion.addEventListener('click', () => {
            agregarOpcion(idPregunta, esSubpregunta); ///TODO///
        });

        var nuevaOpcionMultiple = document.createElement("div");
        nuevaOpcionMultiple.id = "opcionMultiple_"+idPregunta;
        nuevaOpcionMultiple.hidden = true;
        nuevaOpcionMultiple.appendChild(nuevasOpciones);
        nuevaOpcionMultiple.appendChild(nuevoBotonOpcion);

        return nuevaOpcionMultiple;
    }


    /**
     * Crear un espacio para adjuntar un archivo
     * @param {number} idCategoria
     * @param {number} idSubcategoria
     * @param {string} idPregunta
     * @returns HTMLDivElement
     */
    function crearEspacioAdjunto(idCategoria,idSubcategoria,idPregunta){
        var i = idCategoria - 1;
        var j = idSubcategoria -1;
        var nuevoEspacioAdjunto = document.createElement("div");
        nuevoEspacioAdjunto.style = "margin-top: 10px;";
        adjuntoText = document.createTextNode("Adjuntar archivo");
        adjuntoLabel = document.createElement("label");
        adjuntoLabel.className = "form-label";
        adjuntoLabel.appendChild(adjuntoText);
        nuevoAdjunto = document.createElement("input");
        nuevoAdjunto.className = "form-control";
        nuevoAdjunto.type = "file";
        nuevoAdjunto.name = "adjuntos["+i+"]["+j+"][]";
        nuevoEspacioAdjunto.appendChild(adjuntoLabel);
        nuevoEspacioAdjunto.appendChild(nuevoAdjunto);
        nuevoEspacioAdjunto.id = "adjunto_" + idPregunta;

        return nuevoEspacioAdjunto;
    }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agregarPregunta(idCategoria,idSubcategoria) {
        // crea un nuevo div
        // y añade contenido
        if($("#preguntas_" + idCategoria + "_" + idSubcategoria)[0].lastChild != null){
            var idPreguntaActual = $("#preguntas_" + idCategoria + "_" + idSubcategoria)[0].lastChild.id;
            var idNuevaPregunta = parseInt(idPreguntaActual.split('_')[3]) + 1;
        }
        else{
            var idNuevaPregunta = 1;
        }
        var i = idCategoria-1; // valor en el arreglo de categorias
        var j = idSubcategoria-1; // valor en el arreglo de subcategorias
        var k = idNuevaPregunta-1;

        var nuevaPregunta = document.createElement("div");
        nuevaPregunta.id = "Pregunta_" + idCategoria + "_" + idSubcategoria + "_" + idNuevaPregunta;

        ultimaSubpreguntaId = document.createAttribute("ultimaSubpreguntaId");
        ultimaSubpreguntaId.value=0;
        nuevaPregunta.setAttributeNode(ultimaSubpreguntaId);


        var divPreguntaPadre = document.createElement("div");
        var divPreguntaInput = document.createElement("div");

        divPreguntaPadre.className = "row";
        divPreguntaPadre.style = "margin-bottom: 10px;";

        var nuevoIdentificadorPregunta = crearLabel(idNuevaPregunta + ". Pregunta");
        nuevoIdentificadorPregunta.className = "form-check-label col-sm";
        nuevoIdentificadorPregunta.style = "margin-bottom: 10px;";

        //agregar <input type="hidden" name="id_preguntas[i][j][]"></input>
        var nuevoIdPregunta = document.createElement("input");
        nuevoIdPregunta.name = "id_preguntas["+i+"]["+j+"][]";
        nuevoIdPregunta.type = "hidden";

        var nuevoTituloPregunta = document.createElement("input");
        nuevoTituloPregunta.name = "preguntas["+i+"]["+j+"][]";
        nuevoTituloPregunta.placeholder = "Agregar Pregunta";
        nuevoTituloPregunta.className = "form-control col-12";


        divPreguntaInput.appendChild(nuevoIdPregunta);
        divPreguntaInput.appendChild(nuevoTituloPregunta);
        divPreguntaPadre.appendChild(nuevoIdentificadorPregunta);
        divPreguntaPadre.appendChild(divPreguntaInput);

        var divTipoPregunta = document.createElement("div");
        var divTipoPreguntaSelect = document.createElement("div");
        var divTipoPreguntaCheck = document.createElement("div");
        var divTipoPreguntaText = document.createElement("div");


        divTipoPregunta.style = "display: flex; align-items: center;";
        divTipoPreguntaSelect.style = "margin-right: 20px;";
        divTipoPreguntaCheck.className = "form-check";
        divTipoPreguntaText.style = "margin: 10px 0px 10px 52px;";

        var labelTipoPregunta = crearLabel("Tipo de Pregunta");
        labelTipoPregunta.className = "form-check-label";
        labelTipoPregunta.style = "margin-right: 20px;";

        var nuevoSelectTipo = crearSelectTipo(idCategoria,idSubcategoria,nuevaPregunta.id);
        divTipoPreguntaSelect.appendChild(nuevoSelectTipo);

        var nuevoCheckEvidencia = crearCheckEvidencia(nuevaPregunta.id);
        var checkLabel = crearLabel("Evidencia");
        checkLabel.className = "form-check-label";
        divTipoPreguntaCheck.appendChild(nuevoCheckEvidencia);
        divTipoPreguntaCheck.appendChild(checkLabel);

        var nuevaDescripcionEvidencia = crearDescripcionEvidencia(idCategoria,idSubcategoria,nuevaPregunta.id);
        divTipoPreguntaText.appendChild(nuevaDescripcionEvidencia);

        divTipoPregunta.appendChild(labelTipoPregunta);
        divTipoPregunta.appendChild(divTipoPreguntaSelect);
        divTipoPregunta.appendChild(divTipoPreguntaCheck);
        divTipoPregunta.appendChild(divTipoPreguntaText);

        var divAdjuntar = document.createElement("div");
        divAdjuntar.style = "margin-top: 10px;";

        var nuevoEspacioAdjunto = crearEspacioAdjunto(idCategoria,idSubcategoria,nuevaPregunta.id);
        divAdjuntar.appendChild(nuevoEspacioAdjunto);

        var nuevoCiertoFalso = crearCiertoFalso(nuevaPregunta.id);

        var nuevoEspacioRespuesta = crearEspacioRespuesta(nuevaPregunta.id);

        var arrayOpciones = "["+i+"]["+j+"]["+k+"][]";
        var nuevaOpcionMultiple = crearOpcionMultiple(nuevaPregunta.id,arrayOpciones,false);
        var hr = document.createElement("hr");
        var hr2 = document.createElement("hr");


        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.id = "Cuerpo_"+nuevaPregunta.id;
        nuevoCuerpoPregunta.className = "card-body";

        //crear boton de subpregunta
        var nuevoBotonSubpregunta = document.createElement("button");
        var iconAddSub = document.createElement("i");
        iconAddSub.className = "fa fa-plus";

        var divSubpreguntas = document.createElement("div");
        divSubpreguntas.id = "Subpreguntas_"+nuevaPregunta.id;
        divSubpreguntas.hidden = true;

        botonText = document.createTextNode(" Agregar subpregunta");
        nuevoBotonSubpregunta.appendChild(iconAddSub);
        nuevoBotonSubpregunta.appendChild(botonText);
        nuevoBotonSubpregunta.className = "btn btn-primary";
        nuevoBotonSubpregunta.style = "margin-bottom: 10px;";

        nuevoBotonSubpregunta.id = "Boton_" + idCategoria + "_" + idSubcategoria + "_" + idNuevaPregunta;
        nuevoBotonSubpregunta.type = "button";
        divSubpreguntas.appendChild(nuevoBotonSubpregunta);


        nuevaPregunta.appendChild(divPreguntaPadre);
        nuevaPregunta.appendChild(divTipoPregunta);
        nuevaPregunta.appendChild(divAdjuntar);

        nuevaPregunta.appendChild(nuevoCuerpoPregunta);
        nuevaPregunta.appendChild(hr2);
        nuevoCuerpoPregunta.appendChild(nuevoCiertoFalso);
        nuevoCuerpoPregunta.appendChild(nuevaOpcionMultiple);
        nuevoCuerpoPregunta.appendChild(nuevoEspacioRespuesta);
        nuevoCuerpoPregunta.appendChild(divSubpreguntas);;


        nuevoBotonSubpregunta.addEventListener('click', () => {
            agregarSubPregunta(idCategoria,idSubcategoria,idNuevaPregunta)}
        );

        // añade el elemento creado y su contenido al DOM
        $("#preguntas_" + idCategoria + "_" + idSubcategoria)[0].appendChild(nuevaPregunta);

    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agregarSubPregunta(idCategoria,idSubcategoria,idPregunta) {
        // crea un nuevo div
        // y añade contenido
        var idNuevaSubPregunta =  ++($("#Pregunta_"+idCategoria + "_" + idSubcategoria + "_" + idPregunta)[0].attributes.ultimaSubpreguntaId.value);
        var i = idCategoria-1; // valor en el arreglo de categorias
        var j = idSubcategoria-1; // valor en el arreglo de subcategorias
        var k = idPregunta-1; // valor en el arreglo de preguntas
        var l = idNuevaSubPregunta-1;

        var nuevaSubPregunta = document.createElement("div");
        nuevaSubPregunta.id = idCategoria + "_" + idSubcategoria + "_" + idPregunta + "_SubPregunta_" + idNuevaSubPregunta;

        var nuevoEncabezadoPregunta = document.createElement("div");

        var nuevoIdentificadorPregunta = document.createElement("label");
        nuevoIdentificadorPregunta.className = "form-check-label col-sm";
        nuevoIdentificadorPregunta.style = "margin-bottom: 10px;";
        identificadorText = document.createTextNode(idPregunta + "." + idNuevaSubPregunta + ". Subpregunta");
        nuevoIdentificadorPregunta.appendChild(identificadorText);

        //agregar <input type="hidden" name="id_preguntas[i][j][]"></input>
        var nuevoIdPregunta = document.createElement("input");
        nuevoIdPregunta.name = "id_subpreguntas["+i+"]["+j+"]["+k+"][]";
        nuevoIdPregunta.type = "hidden";

        var nuevoTituloPregunta = document.createElement("input");
        nuevoTituloPregunta.className = "form-control col-12";
        nuevoTituloPregunta.name = "subpreguntas["+i+"]["+j+"]["+k+"][]";
        nuevoTituloPregunta.placeholder = "Agregar Subpregunta";

        var divInputSubpregunta = document.createElement("div");
        divInputSubpregunta.appendChild(nuevoIdPregunta);
        divInputSubpregunta.appendChild(nuevoTituloPregunta);

        var divPadreSubpreguntaInput = document.createElement("div");
        divPadreSubpreguntaInput.className= "row";
        divPadreSubpreguntaInput.style = "margin-bottom: 10px;";

        divPadreSubpreguntaInput.appendChild(nuevoIdentificadorPregunta);
        divPadreSubpreguntaInput.appendChild(divInputSubpregunta);

        //agregando estilos al div que envuelve al tipo de subpregunta
        var divStyleSubpregunta = document.createElement("div");
        divStyleSubpregunta.style = "display: flex; align-items: center;";

        var labelSubpregunta = crearLabel("Tipo de Subpregunta");
        labelSubpregunta.className = "form-check-label";
        labelSubpregunta.style = "margin-right: 20px;";

        //agregando estilos al select
        var nuevoSelectTipo = crearSelectTipoSub(idCategoria,idSubcategoria,idPregunta,nuevaSubPregunta.id);
        nuevoSelectTipo.className = "form-select";

        var divSelectSubpregunta = document.createElement("div");
        divSelectSubpregunta.style = "margin-right: 20px;";
        divSelectSubpregunta.appendChild(nuevoSelectTipo);

        /* var nuevoCheckEvidencia = crearCheckEvidencia(nuevaSubPregunta.id);
        nuevoCheckEvidencia.className = "form-check-input";

        var checkLabel = crearLabel("Agregar Evidencia");
        checkLabel.className = "form-check-label";

        var divCheck = document.createElement("div");
        divCheck.className = "form-check";
        divCheck.appendChild(nuevoCheckEvidencia);
        divCheck.appendChild(checkLabel);

        var divTextArea = document.createElement("div");
        divTextArea.style = "margin: 10px 0px 10px 52px;";
        var nuevaDescripcionEvidencia = crearDescripcionEvidenciaSub(idCategoria,idSubcategoria,idPregunta,nuevaSubPregunta.id);
        divTextArea.appendChild(nuevaDescripcionEvidencia); */

        ///agregamos los elementos hijos al div
        divStyleSubpregunta.appendChild(labelSubpregunta);
        divStyleSubpregunta.appendChild(divSelectSubpregunta);
        //divStyleSubpregunta.appendChild(divCheck);
        //divStyleSubpregunta.appendChild(divTextArea);

        var nuevoCiertoFalso = crearCiertoFalso(nuevaSubPregunta.id);

        var nuevoEspacioRespuesta = crearEspacioRespuesta(nuevaSubPregunta.id);

        var arrayOpciones = "["+i+"]["+j+"]["+k+"]["+l+"][]";
        var nuevaOpcionMultiple = crearOpcionMultiple(nuevaSubPregunta.id,arrayOpciones,true);

        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.id = "Cuerpo_"+nuevaSubPregunta.id;
        nuevoCuerpoPregunta.className = "card-body"

        var cuerpoCiertoFalso = document.createElement("div");
        cuerpoCiertoFalso.className = "form-check";

        nuevaSubPregunta.appendChild(nuevoEncabezadoPregunta);

        nuevoEncabezadoPregunta.appendChild(divPadreSubpreguntaInput);
        nuevoEncabezadoPregunta.appendChild(divStyleSubpregunta);
        cuerpoCiertoFalso.appendChild(nuevoCiertoFalso);

        nuevaSubPregunta.appendChild(nuevoCuerpoPregunta);
        nuevoCuerpoPregunta.appendChild(cuerpoCiertoFalso);
        nuevoCuerpoPregunta.appendChild(nuevaOpcionMultiple);
        nuevoCuerpoPregunta.appendChild(nuevoEspacioRespuesta);
        // añade el elemento creado y su contenido al DOM
        var buttonAgregar = document.getElementById("Boton_" + idCategoria  + "_" + idSubcategoria +  "_" + idPregunta);
        var myString = "#Subpreguntas_Pregunta_" + idCategoria  + "_" + idSubcategoria +  "_" + idPregunta;
        $(myString)[0].insertBefore(nuevaSubPregunta,buttonAgregar);

        var lineaSeparacion = document.createElement("hr");
        nuevaSubPregunta.appendChild(lineaSeparacion);
    }

    function habilitarEvidencia(idPregunta){
        if($("#check_"+idPregunta)[0].checked){
            $("#evidencia_"+idPregunta)[0].hidden = false;
        }
        else{
            $("#evidencia_"+idPregunta)[0].hidden = true;
            $("#evidencia_"+idPregunta)[0].value="";
        }
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agregarOpcion(idPregunta, esSubpregunta){
        var idOpcionActual = $("#opciones_"+idPregunta)[0].lastElementChild.id;
        console.log(idOpcionActual);
        var idNuevaOpcion =  parseInt(idOpcionActual.split('-')[1]) + 1;
        console.log(idNuevaOpcion);

        var nuevaOpcion= document.createElement("input");
        nuevaOpcion.style ="margin-left: 5px";
        nuevaOpcion.className = "form-control col-3";

        var nuevoBotonEliminar = document.createElement("button");
        nuevoBotonEliminar.className = "btn btn-outline-danger";
        botonText = document.createTextNode("X");
        nuevoBotonEliminar.appendChild(botonText);
        nuevoBotonEliminar.type = "button";
        nuevoBotonEliminar.addEventListener('click', () => {
            eliminarOpcion(idPregunta,idNuevaOpcion)
            this.remove();
        });
        nuevaOpcion.placeholder = "Opción " + idNuevaOpcion;
        if($("#opciones_"+idPregunta)[0].opciones !== undefined){
            if(esSubpregunta){
                nuevaOpcion.name ="subopciones"+($("#opciones_"+idPregunta)[0].opciones);
            }
            else{
                nuevaOpcion.name ="opciones"+($("#opciones_"+idPregunta)[0].opciones);
            }
        }
        else{
            if(esSubpregunta){
                nuevaOpcion.name ="subopciones"+($("#opciones_"+idPregunta)[0].attributes.opciones.value);
            }
            else{
                nuevaOpcion.name ="opciones"+($("#opciones_"+idPregunta)[0].attributes.opciones.value);
            }
        }


        var divPadreOpciones = document.createElement("div");
        divPadreOpciones.style = "display: flex; margin-top: 10px;";
        divPadreOpciones.id = idPregunta+"_opc-"+idNuevaOpcion;
        divPadreOpciones.appendChild(nuevoBotonEliminar);
        divPadreOpciones.appendChild(nuevaOpcion);


        $("#opciones_"+idPregunta)[0].appendChild(divPadreOpciones);
        // $("#opciones_"+idPregunta)[0].appendChild(nuevaOpcion);
    }

    function eliminarOpcion(idPregunta,idOpcion){
        var button = $("#"+idPregunta+"_opc-"+idOpcion);
        button.remove();
    }

    function cambiarTipo(idPregunta,esSubpregunta){
        var tipo = $("#tipo_"+idPregunta+" option:selected")[0].value;
        switch(tipo){
            case "0":
                $("#ciertoFalso_"+idPregunta)[0].hidden = false;
                $("#res_"+idPregunta)[0].hidden = true;
                $("#opcionMultiple_"+idPregunta)[0].hidden = true;
                if(!esSubpregunta){
                    $("#Subpreguntas_"+idPregunta)[0].hidden = true;
                }
                break;
            case "1":
                $("#ciertoFalso_"+idPregunta)[0].hidden = true;
                $("#res_"+idPregunta)[0].hidden = true;
                $("#opcionMultiple_"+idPregunta)[0].hidden = false;
                if(!esSubpregunta){
                    $("#Subpreguntas_"+idPregunta)[0].hidden = true;
                }
                break;
            case "2":
                $("#ciertoFalso_"+idPregunta)[0].hidden = true;
                $("#res_"+idPregunta)[0].hidden = true;
                $("#opcionMultiple_"+idPregunta)[0].hidden = false;
                if(!esSubpregunta){
                    $("#Subpreguntas_"+idPregunta)[0].hidden = true;
                }
                break;
            case "3":
                $("#ciertoFalso_"+idPregunta)[0].hidden = true;
                $("#res_"+idPregunta)[0].hidden = false;
                $("#opcionMultiple_"+idPregunta)[0].hidden = true;
                if(!esSubpregunta){
                    $("#Subpreguntas_"+idPregunta)[0].hidden = true;
                }
                break;
            case "4":
                $("#ciertoFalso_"+idPregunta)[0].hidden = true;
                $("#res_"+idPregunta)[0].hidden = true;
                $("#opcionMultiple_"+idPregunta)[0].hidden = true;
                $("#Subpreguntas_"+idPregunta)[0].hidden = false;
                break;
            default:
                break;
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function agregarSubcategoria(idCategoria){
    if($("#subCategorias_" + idCategoria)[0].lastChild != null){
        if($("#subCategorias_" + idCategoria)[0].lastChild.id != ""){//si la categoria no esta vacía
            var idSubcategoriaActual = $("#subCategorias_" + idCategoria)[0].lastChild.id;
            var idNuevaSubcategoria = parseInt(idSubcategoriaActual.split('_')[2]) + 1;
        }
        else  var idNuevaSubcategoria = 1;
    }
    else{
        var idNuevaSubcategoria = 1;
    }
    var i = idCategoria-1; // valor en el arreglo de categorias
    var nuevaSubCategoria = document.createElement("div");
    nuevaSubCategoria.style = "margin-top: 10px; border: 1px solid gray; border-radius: 10px; padding: 20px; margin: 10px;";
    nuevaSubCategoria.id = "subCategoria_" + idCategoria + "_" + idNuevaSubcategoria;

    var divSubcategoria = document.createElement("div");
    divSubcategoria.className = "row col-7";

    var labelSubCaterogia = document.createElement("label");
    labelSubCaterogia.className = "col-sm-3 form-label";

    var h5 = document.createElement("h5");
    labelText = document.createTextNode("Subcategoría");
    h5.appendChild(labelText);
    labelSubCaterogia.appendChild(h5);

    divSubcategoria.appendChild(labelSubCaterogia);

    var divHijoSubCategoria = document.createElement("div");
    divHijoSubCategoria.className = "col-sm-9";

    //agregar <input type="hidden" name="id_subcategorias[i][]"></input>
    var nuevoIdSubcategoria = document.createElement("input");
    nuevoIdSubcategoria.name = "id_subcategorias["+i+"][]";
    nuevoIdSubcategoria.type = "hidden";
    divHijoSubCategoria.appendChild(nuevoIdSubcategoria);

    var nuevoNombreSubcategoria = document.createElement("input");
    nuevoNombreSubcategoria.className = "form-control col-6";
    nuevoNombreSubcategoria.name = "subcategorias["+i+"][]";
    nuevoNombreSubcategoria.placeholder = "Nombre de la Subcategoría";
    divHijoSubCategoria.appendChild(nuevoNombreSubcategoria);

    divSubcategoria.appendChild(divHijoSubCategoria);

    nuevaSubCategoria.appendChild(divSubcategoria);

    // se crea nuevo div para las preguntas
    var nuevasPreguntas = document.createElement("div");
    nuevasPreguntas.id = "preguntas_" + idCategoria + "_" + idNuevaSubcategoria;

    //Agrega el boton de agregar pregunta
    var nuevoBotonPregunta = document.createElement("button");
    nuevoBotonPregunta.style = "margin-left: 10px;";
    nuevoBotonPregunta.className = "btn btn-primary";
    nuevoBotonPregunta.type = "button";
    nuevoBotonPregunta.id = "buttonAgregar_" + idCategoria + "_" + idNuevaSubcategoria;

    botonText = document.createTextNode("Agregar pregunta");
    nuevoBotonPregunta.appendChild(botonText);

    //se agregan los elementos a la nueva categoria
    nuevaSubCategoria.appendChild(nuevasPreguntas);
    $("#subCategorias_" + idCategoria)[0].appendChild(nuevaSubCategoria);

    //se agrega una pregunta a la nueva subcategoria
    agregarPregunta(idCategoria,idNuevaSubcategoria);
    // Evento que dispara la función agregar
    nuevoBotonPregunta.addEventListener('click',function(){
        agregarPregunta(idCategoria,idNuevaSubcategoria)}
    );

    nuevaSubCategoria.appendChild(nuevoBotonPregunta);
    
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function agregarCategoria(){
    var idCategoriaActual = $("#categorias")[0].lastChild.id;
    var nuevaCategoria = document.createElement("div");
    nuevaCategoria.style = "border: 1px solid gray; border-radius: 10px; padding: 20px; margin: 10px;";
    var idNuevaCategoria = parseInt(idCategoriaActual.split('_')[1]) + 1;
    nuevaCategoria.id = "categoria_" + idNuevaCategoria;
    
    //se crea el encabezado de la categoria
    let contenedorCategoria = document.createElement("div");
    contenedorCategoria.className = "row col-7";

    let labelCategorias = document.createElement("label");
    labelCategorias.className = "col-sm-3 form-label";

    let h5 = document.createElement("h5");
    labelText = document.createTextNode("Categoría");
    h5.appendChild(labelText);
    labelCategorias.appendChild(h5);

    contenedorCategoria.appendChild(labelCategorias);

    let contenedorInputCategoria = document.createElement("div");
    contenedorInputCategoria.className = "col-sm-9";


    // var nuevoEncabezadoCategoria = document.createElement("div");
    // nuevoEncabezadoCategoria.className = "card-header";

    //agregar <input type="hidden" name="id_categorias[]"></input>
    var nuevoIdCategoria = document.createElement("input");
    nuevoIdCategoria.name = "id_categorias[]";
    nuevoIdCategoria.type = "hidden";
    contenedorInputCategoria.appendChild(nuevoIdCategoria);

    var nuevoNombreCategoria = document.createElement("input");
    nuevoNombreCategoria.className = "form-control col-6";
    nuevoNombreCategoria.name = "categorias[]";
    nuevoNombreCategoria.placeholder = "Nombre de la Categoría";

    contenedorInputCategoria.appendChild(nuevoNombreCategoria);
    contenedorCategoria.appendChild(contenedorInputCategoria);

    nuevaCategoria.appendChild(contenedorCategoria);


    //se agrega la nueva categoria
    $("#categorias")[0].appendChild(nuevaCategoria);

    // se crea nuevo div para las subcategorias
    var nuevasSubCategorias = document.createElement("div");
    nuevasSubCategorias.id = "subCategorias_" + idNuevaCategoria;

    nuevaCategoria.appendChild(nuevasSubCategorias);
    

    //se agrega una subcategoria a la nueva categoria
    agregarSubcategoria(idNuevaCategoria);

    //Agrega el boton de agregar subcategoria
    var nuevoBotonSubcategoria = document.createElement("button");
    nuevoBotonSubcategoria.className = "btn btn-primary";
    nuevoBotonSubcategoria.style = "margin-left: 10px;";
    botonText = document.createTextNode("Agregar Subcategoría");
    nuevoBotonSubcategoria.appendChild(botonText);
    nuevoBotonSubcategoria.addEventListener('click',function(){
        agregarSubcategoria(idNuevaCategoria)}
    );
    nuevoBotonSubcategoria.id = "btnAgregarSubcategoria_" + idNuevaCategoria;
    nuevoBotonSubcategoria.type = "button";
    nuevaCategoria.appendChild(nuevoBotonSubcategoria);
}

