@extends('layouts.app')
@section('content')
<div class="section">
    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 py-3">
                <li class="breadcrumb-item"><a class="fw-light" href="/home" style="text-decoration: none;">Inicio</a></li>
                <li class="breadcrumb-item active fw-light" aria-current="page">Plantilla {{ $plantilla['plantilla_nombre'] }} - {{ $plantilla['plantilla_version'] }}</li>
            </ol>
            </nav>
        </div>
    </div>
    
        <!-- <form action="/plantilla/update/{{ $plantilla['plantilla_id']}}" method="POST"> -->
        <!-- @csrf 
        @method('put')
        <div class="card" style="text-align: center;">
            <div class="card-header"><h4>Plantilla {{ $plantilla['plantilla_nombre'] }} - {{ $plantilla['plantilla_version'] }}</h4></div>
        </div> -->
    <form id="form_guardar_plantilla" action="#" method="POST">
    
    <div id="categorias" class="col-md-12">
        <div id="categoria_1" class="card-header" >
            <div class="card-header"><input type="hidden" name="id_categorias[]"><input type="text" name="categorias[]" placeholder="Categoría"></div>
            <div id="subCategoria_1_1" class="card-header">
                <div class="card-header"><input type="hidden" name="id_subcategorias[0][]"><input type="text" name="subcategorias[0][]" placeholder="Subcategoría"></div>
                <div id="preguntas_1_1" class="col-md-12">
                    <div id="Pregunta_1_1_1" class="card" ultimaSubpreguntaId=0>
                        <div class="card-header">
                            <label>1.</label>
                            <input type="hidden" name="id_preguntas[0][0][]">
                            <input type="text"  name="preguntas[0][0][]" placeholder="Pregunta"></input>
                            <select id="tipo_Pregunta_1_1_1" name="tipos[0][0][]" value="Pregunta" onChange="cambiarTipo('Pregunta_1_1_1')">
                                <option value="0">Cierto o falso</option>
                                <option value="1">Opción múltiple</option>
                                <option value="2">Selección múltiple</option>
                                <option value="3">Abierta</option>
                            </select>
                            <input id=check_Pregunta_1_1_1 type="checkbox" onChange="habilitarEvidencia('Pregunta_1_1_1')">Evidencia</input>
                            <textarea id=evidencia_Pregunta_1_1_1 name="evidencias[0][0][]" placeholder="Describir evidencia" hidden></textarea>
                            <div id="adjunto_Pregunta_1_1_1">
                                <label>Adjunto</label>
                                <input name="adjuntos[0][0][]" type="file"></input>
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
                                <button id="+opc_1" type="button" onClick="agregarOpcion('Pregunta_1_1_1')">Añadir opción</button>
                            </div>
                            <input id="res_Pregunta_1_1_1" type="text" value="Respuesta" disabled hidden=true></input>
                        </div>
                        <button id="Boton_1_1_1" type="button" onClick="agregarSubPregunta(1,1,1)">Agregar subpregunta</button>
                    </div>
                </div>   
                <button id="buttonAgregar_1_1" type="button" onClick="agregarPregunta(1,1)">Agregar pregunta</button>
            </div>
        </div>
        <button id="btnAgregarSubcategoria_1" type="button" onClick="agregarSubcategoria(1)">Agregar subcategoria</button> 
    </div>
    <button id="btnAgregarCategoria" type="button" onClick="agregarCategoria()" >Agregar categoria</button>
    <button id="btnGuardar" type="submit" class="btn btn-success">Guardar</button>
    </form>
    
</div>

<script type="application/javascript" src="{{ asset('js/edicion_plantilla.js') }}"></script>

@endsection

