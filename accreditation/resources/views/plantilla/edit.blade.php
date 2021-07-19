@extends('layouts.app')
@section('content')
<?php
    $i = 1;
?>
<div class="main-container">
    <div class="row justify-content-center">
        <form action="/plantilla/update/{{ $plantilla['plantilla_id']}}" method="POST">
        @csrf 
        @method('put')
        <div class="card" style="text-align: center;">
            <div class="card-header"><h4>Plantilla {{ $plantilla['plantilla_nombre'] }} - {{ $plantilla['plantilla_version'] }}</h4></div>
        </div>
        <div id="categorias" class="col-md-12">
            @foreach($categorias as $categoria)
            <div id="categoria_{{$i}}" class="card-header" >
                <div class="card-header"><input type="hidden" name="id_categorias[]" value = "{{$categoria->id}}"><input type="text" name="categorias[]" value = "{{$categoria->descripcion}}" placeholder="Categoría"></div>
                @foreach($subcategorias[$i-1] as $subcategoria)
                <div id="subCategoria_{{$i}}_1" class="card-header">
                    <div class="card-header"><input type="hidden" name="id_subcategorias[{{$i-1}}][]" value = "{{$subcategoria->id}}"><input type="text"  value = "{{$subcategoria->descripcion}}" name="subcategorias[{{$i-1}}][]" placeholder="Subcategoría"></div>
                    <div id="preguntas_{{$i}}_1" class="col-md-12">
                        <div id="Pregunta_{{$i}}_1_1" class="card" ultimaSubpreguntaId=0>
                            <div class="card-header">
                                <label>1.</label>
                                <input type="text" placeholder="Pregunta"></input>
                                <select id="tipo_Pregunta_{{$i}}_1_1" value="Pregunta" onChange="cambiarTipo('Pregunta_1_1_1')">
                                    <option value="0">Cierto o falso</option>
                                    <option value="1">Opción múltiple</option>
                                    <option value="2">Selección múltiple</option>
                                    <option value="3">Abierta</option>
                                </select>
                                <input id=check_Pregunta_{{$i}}_1_1 type="checkbox" onChange="habilitarEvidencia('Pregunta_1_1_1')">Evidencia</input>
                                <textarea id=evidencia_Pregunta_{{$i}}_1_1 placeholder="Describir evidencia" hidden></textarea>
                                <div id="adjunto_Pregunta_{{$i}}_1_1">
                                    <label>Adjunto</label>
                                    <input type="file"></input>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="ciertoFalso_Pregunta_{{$i}}_1_1">
                                    <input type="radio" disabled></input>
                                    <label>Cierto</label>
                                    <input type="radio" disabled></input>
                                    <label>Falso</label>
                                </div>
                                <div id="opcionMultiple_Pregunta_{{$i}}_1_1" hidden=true>
                                    <div id="opciones_Pregunta_{{$i}}_1_1">
                                        <input type="radio" disabled></input>
                                        <input id=Pregunta_{{$i}}_1_1_opc-1 type=text placeholder="Opción 1"></input>
                                    </div>
                                    <button id="+opc_1" type="button" onClick="agregarOpcion('Pregunta_{{$i}}_1_1')">Añadir opción</button>
                                </div>
                                <input id="res_Pregunta_{{$i}}_1_1" type="text" value="Respuesta" disabled hidden=true></input>
                            </div>
                            <button id="Boton_{{$i}}_1_1" type="button" onClick="agregarSubPregunta({{$i}},1,1)">Agregar subpregunta</button>
                        </div>
                    </div>   
                    <button id="buttonAgregar_{{$i}}_1" type="button" onClick="agregarPregunta({{$i}},1)">Agregar pregunta</button>
                </div>
                @endforeach
            </div>
            <button id="btnAgregarSubcategoria_{{$i}}" type="button" onClick="agregarSubcategoria({{$i}})">Agregar subcategoria</button>
            <?php
                $i++;
            ?>
            @endforeach 
        </div>
        <button id="btnAgregarCategoria" type="button" onClick="agregarCategoria()" >Agregar categoria</button>
        <button id="btnGuardar" type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
</div>

<script type="application/javascript" src="{{ asset('js/edicion_plantilla.js') }}"></script>

@endsection

