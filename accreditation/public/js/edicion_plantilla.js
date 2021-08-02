
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
        nuevoSelectTipo.options[0] = new Option("Cierto o falso",0);
        nuevoSelectTipo.options[1] = new Option("Opción múltiple",1);
        nuevoSelectTipo.options[2] = new Option("Selección múltiple",2);
        nuevoSelectTipo.options[3] = new Option("Abierta",3);
        nuevoSelectTipo.id = "tipo_" + idPregunta;
        nuevoSelectTipo.name = "tipos["+i+"]["+j+"][]";
        nuevoSelectTipo.addEventListener('click',function(){ 
            cambiarTipo(idPregunta)}
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
        nuevoSelectTipo.options[0] = new Option("Cierto o falso",0);
        nuevoSelectTipo.options[1] = new Option("Opción múltiple",1);
        nuevoSelectTipo.options[2] = new Option("Selección múltiple",2);
        nuevoSelectTipo.options[3] = new Option("Abierta",3);
        nuevoSelectTipo.id = "tipo_" + idSubpregunta;
        nuevoSelectTipo.name = "tipos_sub["+i+"]["+j+"]["+k+"][]";
        nuevoSelectTipo.addEventListener('click',function(){ 
            cambiarTipo(idSubpregunta)}
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
        nuevaDescripcionEvidencia.placeholder = "Describir evidencia";
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
        nuevaDescripcionEvidencia.placeholder = "Describir evidencia";
        nuevaDescripcionEvidencia.id = "evidencia_" + idSubpregunta;
        nuevaDescripcionEvidencia.name = "evidencias["+i+"]["+j+"]["+k+"][]";
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
        nuevaOpcion.id = idPregunta + "_opc-1";
        var nuevasOpciones = document.createElement("div");
        nuevasOpciones.id = "opciones_" + idPregunta;
        nuevasOpciones.appendChild(nuevaOpcionRadio);
        nuevasOpciones.appendChild(nuevaOpcion);

        var nuevoBotonOpcion = document.createElement("button"); 
        botonText1 = document.createTextNode("Añadir opción");
        nuevoBotonOpcion.appendChild(botonText1);
        nuevoBotonOpcion.type = "button"; //se debe especificar que el boton es de tipo button o si no el default será tipo submit
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
        adjuntoText = document.createTextNode("Adjunto");
        adjuntoLabel = document.createElement("label");
        adjuntoLabel.appendChild(adjuntoText);
        nuevoAdjunto = document.createElement("input");
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

        var nuevaPregunta = document.createElement("div");
        nuevaPregunta.className = "card";
        nuevaPregunta.id = "Pregunta_" + idCategoria + "_" + idSubcategoria + "_" + idNuevaPregunta;

        ultimaSubpreguntaId = document.createAttribute("ultimaSubpreguntaId");
        ultimaSubpreguntaId.value=0;
        nuevaPregunta.setAttributeNode(ultimaSubpreguntaId);
        
        var nuevoEncabezadoPregunta = document.createElement("div");
        nuevoEncabezadoPregunta.className = "card-header";

        var nuevoIdentificadorPregunta = crearLabel(idNuevaPregunta + ".")

        //agregar <input type="hidden" name="id_preguntas[i][j][]"></input>
        var nuevoIdPregunta = document.createElement("input"); 
        nuevoIdPregunta.name = "id_preguntas["+i+"]["+j+"][]";
        nuevoIdPregunta.type = "hidden";

        var nuevoTituloPregunta = document.createElement("input");
        nuevoTituloPregunta.name = "preguntas["+i+"]["+j+"][]";
        nuevoTituloPregunta.placeholder = "Pregunta";

        var nuevoSelectTipo = crearSelectTipo(idCategoria,idSubcategoria,nuevaPregunta.id);

        var nuevoCheckEvidencia = crearCheckEvidencia(nuevaPregunta.id);

        var checkLabel = crearLabel("Evidencia");

        var nuevaDescripcionEvidencia = crearDescripcionEvidencia(idCategoria,idSubcategoria,nuevaPregunta.id);

        var nuevoEspacioAdjunto = crearEspacioAdjunto(idCategoria,idSubcategoria,nuevaPregunta.id);

        var nuevoCiertoFalso = crearCiertoFalso(nuevaPregunta.id);

        var nuevoEspacioRespuesta = crearEspacioRespuesta(nuevaPregunta.id);

        var nuevaOpcionMultiple = crearOpcionMultiple(nuevaPregunta.id);
        
        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.className = "card-body"

        nuevaPregunta.appendChild(nuevoEncabezadoPregunta); 
        nuevoEncabezadoPregunta.appendChild(nuevoIdPregunta);
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
        $("#preguntas_" + idCategoria + "_" + idSubcategoria)[0].appendChild(nuevaPregunta);
        //crear boton de subpregunta
        var nuevoBotonSubpregunta = document.createElement("button");
        botonText = document.createTextNode("Agregar subpregunta");
        nuevoBotonSubpregunta.appendChild(botonText);
        nuevoBotonSubpregunta.addEventListener('click',function(){ 
            agregarSubPregunta(idCategoria,idSubcategoria,idNuevaPregunta)}
        );
        nuevoBotonSubpregunta.id = "Boton_" + idNuevaPregunta;
        nuevoBotonSubpregunta.type = "button";
        nuevaPregunta.appendChild(nuevoBotonSubpregunta);  
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agregarSubPregunta(idCategoria,idSubcategoria,idPregunta) {
        // crea un nuevo div
        // y añade contenido
        var idNuevaSubPregunta =  ++($("#Pregunta_"+idCategoria + "_" + idSubcategoria + "_" + idPregunta)[0].attributes.ultimaSubpreguntaId.value);
        var i = idCategoria-1; // valor en el arreglo de categorias
        var j = idSubcategoria-1; // valor en el arreglo de subcategorias
        var k = idPregunta-1; // valor en el arreglo de preguntas

        var nuevaSubPregunta = document.createElement("div");
        nuevaSubPregunta.className = "card";
        nuevaSubPregunta.id = idCategoria + "_" + idSubcategoria + "_" + idPregunta + "_SubPregunta_" + idNuevaSubPregunta;

        var nuevoEncabezadoPregunta = document.createElement("div");
        nuevoEncabezadoPregunta.className = "card-header"

        var nuevoIdentificadorPregunta = document.createElement("label");
        identificadorText = document.createTextNode(idPregunta + "." + idNuevaSubPregunta + ".");
        nuevoIdentificadorPregunta.appendChild(identificadorText);

        //agregar <input type="hidden" name="id_preguntas[i][j][]"></input>
        var nuevoIdPregunta = document.createElement("input"); 
        nuevoIdPregunta.name = "id_subpreguntas["+i+"]["+j+"]["+k+"][]";
        nuevoIdPregunta.type = "hidden";

        var nuevoTituloPregunta = document.createElement("input");
        nuevoTituloPregunta.name = "subpreguntas["+i+"]["+j+"]["+k+"][]";
        nuevoTituloPregunta.placeholder = "Subpregunta"

        var nuevoSelectTipo = crearSelectTipoSub(idCategoria,idSubcategoria,idPregunta,nuevaSubPregunta.id);

        var nuevoCheckEvidencia = crearCheckEvidencia(nuevaSubPregunta.id);

        var checkLabel = crearLabel("Evidencia");

        var nuevaDescripcionEvidencia = crearDescripcionEvidenciaSub(idCategoria,idSubcategoria,idPregunta,nuevaSubPregunta.id);

        var nuevoCiertoFalso = crearCiertoFalso(nuevaSubPregunta.id);

        var nuevoEspacioRespuesta = crearEspacioRespuesta(nuevaSubPregunta.id);

        var nuevaOpcionMultiple = crearOpcionMultiple(nuevaSubPregunta.id);

        var nuevoCuerpoPregunta = document.createElement("div");
        nuevoCuerpoPregunta.className = "card-body"

        nuevaSubPregunta.appendChild(nuevoEncabezadoPregunta); 
        nuevoEncabezadoPregunta.appendChild(nuevoIdPregunta);
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
        var buttonAgregar = document.getElementById("Boton_" + idCategoria  + "_" + idSubcategoria +  "_" + idPregunta);
        $("#Pregunta_" + idCategoria  + "_" + idSubcategoria +  "_" + idPregunta)[0].insertBefore(nuevaSubPregunta,buttonAgregar);
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
    function agregarOpcion(idPregunta){
        var idOpcionActual = $("#opciones_"+idPregunta)[0].lastChild.id;
        var idNuevaOpcion =  parseInt(idOpcionActual.split('-')[1]) + 1;
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
        nuevaOpcion.id = idPregunta+"_opc-"+idNuevaOpcion;
        
        $("#opciones_"+idPregunta)[0].appendChild(nuevoBotonEliminar);
        $("#opciones_"+idPregunta)[0].appendChild(nuevaOpcion);
    }

    function eliminarOpcion(idPregunta,idOpcion){
        var button = $("#"+idPregunta+"_opc-"+idOpcion);
        button.remove();
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

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function agregarSubcategoria(idCategoria){
        if($("#categoria_" + idCategoria)[0].lastChild != null){
            if($("#categoria_" + idCategoria)[0].lastChild.id != ""){//si la categoria no esta vacía
                var idSubcategoriaActual = $("#categoria_" + idCategoria)[0].lastChild.id;
                var idNuevaSubcategoria = parseInt(idSubcategoriaActual.split('_')[2]) + 1;
            }
            else  var idNuevaSubcategoria = 1;
        }
        else{
            var idNuevaSubcategoria = 1;
        }
        var i = idCategoria-1; // valor en el arreglo de categorias
        var nuevaSubCategoria = document.createElement("div");
        nuevaSubCategoria.className = "card-header";
        
        nuevaSubCategoria.id = "subCategoria_" + idCategoria + "_" + idNuevaSubcategoria; 
        //se crea el encabezado de la subcategoria
        var nuevoEncabezadoSubcategoria = document.createElement("div"); 
        nuevoEncabezadoSubcategoria.className = "card-header"; 

        //agregar <input type="hidden" name="id_subcategorias[i][]"></input>
        var nuevoIdSubcategoria = document.createElement("input"); 
        nuevoIdSubcategoria.name = "id_subcategorias["+i+"][]";
        nuevoIdSubcategoria.type = "hidden";
        nuevaSubCategoria.appendChild(nuevoIdSubcategoria);

        var nuevoNombreSubcategoria = document.createElement("input");
        nuevoNombreSubcategoria.name = "subcategorias["+i+"][]";
        nuevoNombreSubcategoria.placeholder = "Subcategoria";
        nuevoEncabezadoSubcategoria.appendChild(nuevoNombreSubcategoria);
        nuevaSubCategoria.appendChild(nuevoEncabezadoSubcategoria);

        // se crea nuevo div para las preguntas
        var nuevasPreguntas = document.createElement("div"); 
        nuevasPreguntas.id = "preguntas_" + idCategoria + "_" + idNuevaSubcategoria;

        //se agregan los elementos a la nueva categoria
        nuevaSubCategoria.appendChild(nuevoEncabezadoSubcategoria);
        nuevaSubCategoria.appendChild(nuevasPreguntas);
        $("#categoria_" + idCategoria)[0].appendChild(nuevaSubCategoria);

        //se agrega una pregunta a la nueva subcategoria
        agregarPregunta(idCategoria,idNuevaSubcategoria);

        //Agrega el boton de agregar pregunta
        var nuevoBotonPregunta = document.createElement("button");
        nuevoBotonPregunta.type = "button";
        botonText = document.createTextNode("Agregar pregunta");
        nuevoBotonPregunta.appendChild(botonText);
        nuevoBotonPregunta.addEventListener('click',function(){ 
            agregarPregunta(idCategoria,idNuevaSubcategoria)}
        );
        nuevoBotonPregunta.id = "buttonAgregar_" + idCategoria + "_" + idNuevaSubcategoria;
        nuevaSubCategoria.appendChild(nuevoBotonPregunta);  
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function agregarCategoria(){
    var idCategoriaActual = $("#categorias")[0].lastChild.id;
    var nuevaCategoria = document.createElement("div");
    nuevaCategoria.className = "card-header";
    var idNuevaCategoria = parseInt(idCategoriaActual.split('_')[1]) + 1;
    nuevaCategoria.id = "categoria_" + idNuevaCategoria; 

    //se crea el encabezado de la categoria
    var nuevoEncabezadoCategoria = document.createElement("div"); 
    nuevoEncabezadoCategoria.className = "card-header"; 

    //agregar <input type="hidden" name="id_categorias[]"></input>
    var nuevoIdCategoria = document.createElement("input"); 
    nuevoIdCategoria.name = "id_categorias[]";
    nuevoIdCategoria.type = "hidden";
    nuevaCategoria.appendChild(nuevoIdCategoria);

    var nuevoNombreCategoria = document.createElement("input");
    nuevoNombreCategoria.name = "categorias[]";
    nuevoNombreCategoria.placeholder = "Categoria";
    nuevoEncabezadoCategoria.appendChild(nuevoNombreCategoria);
    nuevaCategoria.appendChild(nuevoEncabezadoCategoria);


    //se agrega la nueva categoria
    $("#categorias")[0].appendChild(nuevaCategoria);

    //se agrega una subcategoria a la nueva categoria
    agregarSubcategoria(idNuevaCategoria);

    //Agrega el boton de agregar subcategoria
    var nuevoBotonSubcategoria = document.createElement("button");
    botonText = document.createTextNode("Agregar subcategoria");
    nuevoBotonSubcategoria.appendChild(botonText);
    nuevoBotonSubcategoria.addEventListener('click',function(){ 
        agregarSubcategoria(idNuevaCategoria)}
    );
    nuevoBotonSubcategoria.id = "btnAgregarSubcategoria_" + idNuevaCategoria;
    nuevaCategoria.appendChild(nuevoBotonSubcategoria);   
}

