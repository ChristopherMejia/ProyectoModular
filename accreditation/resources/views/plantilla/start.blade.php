@extends('layouts.app')
@section('content')
<div class="main-container">
    <div class="row justify-content-center">
        <div id="preguntas" class="col-md-12">
            <div class="card" style="text-align: center;">
                <div class="card-header"><h4>Plantilla {{ $plantilla['plantilla_nombre'] }} - {{ $plantilla['plantilla_version'] }}</h4></div>
            </div>
            <div id="Pregunta_1" class="card" ultimaSubpreguntaId=0>
                <div class="card-header">
                    <label>1.</label>
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
                        <input type="file"></input>
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
                <button id="buttonAgregar" onClick="agregarPregunta()">Agregar</button> 
            </div>
         </div>   
    </div>
</div>

<script type="application/javascript" src="{{ asset('js/evaluacion.js') }}"></script>

@endsection

