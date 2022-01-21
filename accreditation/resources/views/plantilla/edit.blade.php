@extends('layouts.app')
@section('content')
<?php
    $i = 1;
?>
<div class="section">
    <div class="row justify-content-center">
        <form action="/plantilla/update/{{ $plantilla['plantilla_id']}}" method="POST">
        @csrf 
        @method('put')
        <div class="card" style="text-align: center;">
            <div class="card-header"><h4>Plantilla {{ $plantilla['plantilla_nombre'] }} - {{ $plantilla['plantilla_version'] }}</h4></div>
        </div>
        <div id="categorias" class="col-md-12">
            @foreach($categorias as $categoria)
            <?php
                $j = 1;
            ?>
            <div id="categoria_{{$i}}" class="card-header" >
                <div class="card-header"><input type="hidden" name="id_categorias[]" value = "{{$categoria->id}}"><input type="text" name="categorias[]" value = "{{$categoria->descripcion}}" placeholder="Categoría"></div>
                @foreach($subcategorias[$i-1] as $subcategoria)
                <?php
                    $k = 1;
                ?>
                <div id="subCategoria_{{$i}}_{{$j}}" class="card-header">
                    <div class="card-header"><input type="hidden" name="id_subcategorias[{{$i-1}}][]" value = "{{$subcategoria->id}}"><input type="text"  value = "{{$subcategoria->descripcion}}" name="subcategorias[{{$i-1}}][]" placeholder="Subcategoría"></div>
                    <div id="preguntas_{{$i}}_{{$j}}" class="col-md-12">
                        @foreach($preguntas[$i-1][$j-1] as $pregunta)
                        <?php
                            $l = 1;
                        ?>
                        <div id="Pregunta_{{$i}}_{{$j}}_{{$k}}" class="card" ultimaSubpreguntaId={{count($subpreguntas[$i-1][$j-1][$k-1])}}>
                            <div class="card-header">
                                <label>{{$k}}.</label>
                                <input type="hidden" name="id_preguntas[{{$i-1}}][{{$j-1}}][]" value = "{{$pregunta->id}}"> 
                                <input type="text" value = "{{$pregunta->descripcion}}" name="preguntas[{{$i-1}}][{{$j-1}}][]" placeholder="Pregunta"></input>
                                <select id="tipo_Pregunta_{{$i}}_{{$j}}_{{$k}}" name="tipos[{{$i-1}}][{{$j-1}}][]" onChange="cambiarTipo('Pregunta_{{$i}}_{{$j}}_{{$k}}')">
                                    <option @if($pregunta->idTipo == 0) selected @endif value="0">Cierto o falso</option>
                                    <option @if($pregunta->idTipo == 1) selected @endif value="1">Opción múltiple</option>
                                    <option @if($pregunta->idTipo == 2) selected @endif value="2">Selección múltiple</option>
                                    <option @if($pregunta->idTipo == 3) selected @endif value="3">Abierta</option>
                                </select>
                                <input id=check_Pregunta_{{$i}}_{{$j}}_{{$k}} type="checkbox" @if($pregunta->conEvidencia == 1) checked @endif onChange="habilitarEvidencia('Pregunta_{{$i}}_{{$j}}_{{$k}}')">Evidencia</input>
                                <textarea id=evidencia_Pregunta_{{$i}}_{{$j}}_{{$k}} name="evidencias[{{$i-1}}][{{$j-1}}][]" placeholder="Describir evidencia" @if($pregunta->conEvidencia == 0) hidden @endif>{{$pregunta->descripcionEvidencia}}</textarea>
                                <div id="adjunto_Pregunta_{{$i}}_{{$j}}_{{$k}}">
                                    <label>Adjunto</label>
                                    <input name="adjuntos[{{$i-1}}][{{$j-1}}][]" type="file"></input>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="ciertoFalso_Pregunta_{{$i}}_{{$j}}_{{$k}}" @if($pregunta->idTipo != 0) hidden @endif>
                                    <input type="radio" disabled></input>
                                    <label>Cierto</label>
                                    <input type="radio" disabled></input>
                                    <label>Falso</label>
                                </div>
                                <div id="opcionMultiple_Pregunta_{{$i}}_{{$j}}_{{$k}}" @if($pregunta->idTipo != 1 && $pregunta->idTipo != 2) hidden @endif>
                                    <div id="opciones_Pregunta_{{$i}}_{{$j}}_{{$k}}">
                                        <input type="radio" disabled></input>
                                        <input id=Pregunta_{{$i}}_{{$j}}_{{$k}}_opc-1 type=text placeholder="Opción 1"></input>
                                    </div>
                                    <button id="+opc_1" type="button" onClick="agregarOpcion('Pregunta_{{$i}}_{{$j}}_{{$k}}')">Añadir opción</button>
                                </div>
                                <input id="res_Pregunta_{{$i}}_{{$j}}_{{$k}}" type="text" value="Respuesta" disabled @if($pregunta->idTipo != 3) hidden @endif></input>
                            </div>
                            @foreach($subpreguntas[$i-1][$j-1][$k-1] as $subpregunta)
                            <div id="{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" class="card">
                            <div class="card-header">
                                <label>{{$k}}.{{$l}}.</label>
                                <input type="hidden" name="id_subpreguntas[{{$i-1}}][{{$j-1}}][{{$k-1}}][]" value = "{{$subpregunta->id}}"> 
                                <input type="text" value = "{{$subpregunta->descripcion}}" name="subpreguntas[{{$i-1}}][{{$j-1}}][{{$k-1}}][]" placeholder="Subregunta"></input>
                                <select id="tipo_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" name="tipos_sub[{{$i-1}}][{{$j-1}}][{{$k-1}}][]" onChange="cambiarTipo('{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}')">
                                    <option @if($subpregunta->idTipo == 0) selected @endif value="0">Cierto o falso</option>
                                    <option @if($subpregunta->idTipo == 1) selected @endif value="1">Opción múltiple</option>
                                    <option @if($subpregunta->idTipo == 2) selected @endif value="2">Selección múltiple</option>
                                    <option @if($subpregunta->idTipo == 3) selected @endif value="3">Abierta</option>
                                </select>
                            </div>
                            <div class="card-body">
                                <div id="ciertoFalso_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" @if($subpregunta->idTipo != 0) hidden @endif>
                                    <input type="radio" disabled></input>
                                    <label>Cierto</label>
                                    <input type="radio" disabled></input>
                                    <label>Falso</label>
                                </div>
                                <div id="opcionMultiple_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}"  @if($subpregunta->idTipo != 1 && $subpregunta->idTipo != 2) hidden @endif>
                                    <div id="opciones_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}">
                                        <input type="radio" disabled></input>
                                        <input id={{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}_opc-1 type=text placeholder="Opción 1"></input>
                                    </div>
                                    <button id="+opc_1" type="button" onClick="agregarOpcion('{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}')">Añadir opción</button>
                                </div>
                                <input id="res_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" type="text" value="Respuesta" disabled @if($subpregunta->idTipo != 4) hidden @endif></input>
                            </div>
                            </div>
                            <?php
                                $l++;
                            ?>
                            @endforeach
                            <button id="Boton_{{$i}}_{{$j}}_{{$k}}" type="button" onClick="agregarSubPregunta({{$i}},{{$j}},{{$k}})">Agregar subpregunta</button>
                        </div>
                        <?php
                            $k++;
                        ?>
                        @endforeach
                    </div>   
                    <button id="buttonAgregar_{{$i}}_{{$j}}" type="button" onClick="agregarPregunta({{$i}},{{$j}})">Agregar pregunta</button>
                </div>
                <?php
                    $j++;
                ?>
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

