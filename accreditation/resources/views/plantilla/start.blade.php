@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="row justify-content-center">
            <div class="card" style="text-align: center;">
                    <div class="card-header"><h4>Plantilla {{ $plantilla['plantilla_nombre'] }} - {{ $plantilla['plantilla_version'] }}</h4></div>
                </div>
                <div id="categoria_1" class="card-header" >
                    <div class="card-header"><input type="text" placeholder="Categoría"></div>
                </div>
                <div id="subCategoria_1" class="card-header">
                    <div class="card-header"><input type="text" placeholder="Subcategoría"></div>
                </div>
        <div id="preguntas_1_1" class="col-md-12" categoriaId=1 subcategoriaId=1>
            <div id="Pregunta_1_1_1" class="card" ultimaSubpreguntaId=0>
                <div class="card-header">
                    <label>1.</label>
                    <input type="text" placeholder="Pregunta"></input>
                    <select id="tipo_Pregunta_1_1_1" value="Pregunta" onChange="cambiarTipo('Pregunta_1_1_1')">
                        <option value="0">Cierto o falso</option>
                        <option value="1">Opción múltiple</option>
                        <option value="2">Selección múltiple</option>
                        <option value="3">Abierta</option>
                    </select>
                    <input id=check_Pregunta_1_1_1 type="checkbox" onChange="habilitarEvidencia('Pregunta_1_1_1')">Evidencia</input>
                    <textarea id=evidencia_Pregunta_1_1_1 placeholder="Describir evidencia" hidden></textarea>
                    <div id="adjunto_Pregunta_1_1_1">
                        <label>Adjunto</label>
                        <input type="file"></input>
                    </div>
                </div>
                <div class="card-body">
                    <div id="ciertoFalso_Pregunta_1_1_1">
                        <input type="radio" disabled></input>
                        <label>Cierto</label>
                        <input type="radio" disabled></input>
                        <label>Falso</label>
                    </div>
                    <div id="opcionMultiple_Pregunta_1_1_1" hidden=true>
                        <div id="opciones_Pregunta_1_1_1">
                            <input type="radio" disabled></input>
                            <input id=Pregunta_1_1_1_opc-1 type=text placeholder="Opción 1"></input>
                        </div>
                        <button id="+opc_1" onClick="agregarOpcion('Pregunta_1_1_1')">Añadir opción</button>
                    </div>
                    <input id="res_Pregunta_1_1_1" type="text" value="Respuesta" disabled hidden=true></input>
                </div>
                <button id="Boton_1_1_1" onClick="agregarSubPregunta(1,1,1)">Agregar subpregunta</button>
            </div>
         </div>   
         <button id="buttonAgregar_1_1" onClick="agregarPregunta(1,1)">Agregar pregunta</button>
         <button id="btnAgregarSubcategoria_1_1" onClick="agregarSubcategoria()">Agregar subcategoria</button>
         <button id="btnAgregarCategoria_1" onClick="agregarCategoria()">Agregar categoria</button>
    </div>
</div>

<script type="application/javascript" src="{{ asset('js/evaluacion.js') }}"></script>

@endsection

