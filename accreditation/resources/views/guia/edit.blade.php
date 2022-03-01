@extends('layouts.app')
@section('content')
<?php
    $i = 1;
?>
<div class="section">

    <div class="bg-gray-200 text-sm">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 py-3">
                <li class="breadcrumb-item"><a class="fw-light" href="/home" style="text-decoration: none;">Inicio</a></li>
                <li class="breadcrumb-item"><a class="fw-light" href="/plantillas" style="text-decoration: none;">Plantillas</a></li>
                <li class="breadcrumb-item active fw-light" aria-current="page"> Guia </li>
            </ol>
            </nav>
        </div>
    </div>

        <form action="/guia/update/{{ $guia->id}}" method="POST">
            @csrf
            @method('put')
            <div class="card" style="text-align: center;">
                <div class="card-header"><h4>{{ $guia->programasEducativos->nombre }} - {{ $guia->programasEducativos->nivel }}</h4></div>
            </div>

            <div class="card">
                <div class="card card-nav-tabs card-plain">
                    <div class="card-header header-table">
                        <div class="card-body">

                            <div id="categorias" style=" margin-bottom: 20px;">
                                @foreach($categorias as $categoria)
                                <?php
                                    $j = 1;
                                ?>
                                <div id="categoria_{{$i}}" >
                                    <div class="row col-7">
                                        <label class="col-sm-3 form-label" ><h5>Categoría</h5></label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="id_categorias[]" value = "{{$categoria->id}}">
                                            <input class="form-control col-6" type="text" name="categorias[]" value = "{{$categoria->descripcion}}" placeholder="Categoría">
                                        </div>
                                    </div>
                                    @foreach($subcategorias[$i-1] as $subcategoria)
                                    <?php
                                        $k = 1;
                                    ?>
                                    <div id="subCategoria_{{$i}}_{{$j}}"
                                        style="
                                            margin-top: 10px;
                                            border: 1px solid gray;
                                            border-radius: 10px;
                                            padding: 20px;
                                            margin: 10px;">

                                        <div class="row col-7" >
                                            <label class="col-sm-3 form-label" ><h5>Subcategoría</h5></label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="id_subcategorias[{{$i-1}}][]" value = "{{$subcategoria->id}}">
                                                <input class="form-control col-6" type="text"  value = "{{$subcategoria->descripcion}}" name="subcategorias[{{$i-1}}][]" placeholder="Subcategoría">
                                            </div>
                                        </div>

                                        <div
                                            id="preguntas_{{$i}}_{{$j}}"
                                            style="
                                            border: 1px solid gray;
                                            border-radius: 10px;
                                            padding: 20px;
                                            margin: 10px;
                                            ">

                                            @foreach($preguntas[$i-1][$j-1] as $pregunta)
                                            <?php
                                                $l = 1;
                                            ?>
                                            <div id="Pregunta_{{$i}}_{{$j}}_{{$k}}" ultimaSubpreguntaId={{count($subpreguntas[$i-1][$j-1][$k-1])}}>

                                                <div class="row" style="margin-bottom: 10px;">
                                                    <label class="form-check-label col-sm" style="margin-bottom: 10px;">{{$k}}. Pregunta </label>
                                                    <div>
                                                        <input type="hidden" name="id_preguntas[{{$i-1}}][{{$j-1}}][]" value = "{{$pregunta->id}}">
                                                        <input
                                                            type="text"
                                                            value="{{$pregunta->descripcion}}"
                                                            name="preguntas[{{$i-1}}][{{$j-1}}][]"
                                                            placeholder="Agregar Pregunta"
                                                            class="form-control col-12">
                                                        </input>
                                                    </div>
                                                </div>


                                                    <select id="tipo_Pregunta_{{$i}}_{{$j}}_{{$k}}" name="tipos[{{$i-1}}][{{$j-1}}][]" onChange="cambiarTipo('Pregunta_{{$i}}_{{$j}}_{{$k}}')">
                                                        <option @if($pregunta->tipo == 0) selected @endif value="0">Cierto o falso</option>
                                                        <option @if($pregunta->tipo == 1) selected @endif value="1">Opción múltiple</option>
                                                        <option @if($pregunta->tipo == 2) selected @endif value="2">Selección múltiple</option>
                                                        <option @if($pregunta->tipo == 3) selected @endif value="3">Abierta</option>
                                                    </select>
                                                    <input id=check_Pregunta_{{$i}}_{{$j}}_{{$k}} type="checkbox" @if($pregunta->evidencia == 1) checked @endif onChange="habilitarEvidencia('Pregunta_{{$i}}_{{$j}}_{{$k}}')">Evidencia</input>
                                                    <textarea id=evidencia_Pregunta_{{$i}}_{{$j}}_{{$k}} name="evidencias[{{$i-1}}][{{$j-1}}][]" placeholder="Describir evidencia" @if($pregunta->evidencia == 0) hidden @endif>{{$pregunta->descripcion_evidencia}}</textarea>
                                                    <div id="adjunto_Pregunta_{{$i}}_{{$j}}_{{$k}}">
                                                        <label>Adjunto</label>
                                                        <input name="adjuntos[{{$i-1}}][{{$j-1}}][]" type="file"></input>
                                                    </div>

                                                <div class="card-body">
                                                    <div id="ciertoFalso_Pregunta_{{$i}}_{{$j}}_{{$k}}" @if($pregunta->tipo != 0) hidden @endif>
                                                        <input type="radio" disabled></input>
                                                        <label>Cierto</label>
                                                        <input type="radio" disabled></input>
                                                        <label>Falso</label>
                                                    </div>
                                                    <div id="opcionMultiple_Pregunta_{{$i}}_{{$j}}_{{$k}}" @if($pregunta->tipo != 1 && $pregunta->tipo != 2) hidden @endif>
                                                        <div id="opciones_Pregunta_{{$i}}_{{$j}}_{{$k}}" opciones="[{{$i-1}}][{{$j-1}}][{{$k-1}}][]">
                                                            <div style="display: flex; margin-top: 10px;">
                                                            @if($pregunta->tipo == 1 || $pregunta->tipo == 2)
                                                                <?php $n_opcion = 1; ?>
                                                                @foreach($pregunta->opciones as $opcion)
                                                                    <input type="radio" disabled></input>
                                                                    <input id="Pregunta_{{$i}}_{{$j}}_{{$k}}_opc-{{$n_opcion}}" name="opciones[{{$i-1}}][{{$j-1}}][{{$k-1}}][]" type=text value="{{$opcion}}" placeholder="Opción 1"></input>
                                                                    <?php $n_opcion++; ?>
                                                                @endforeach
                                                            @else
                                                                <input type="radio" disabled></input>
                                                                <input id=Pregunta_{{$i}}_{{$j}}_{{$k}}_opc-1 name="opciones[{{$i-1}}][{{$j-1}}][{{$k-1}}][]" type=text placeholder="Opción 1"></input>
                                                            @endif
                                                            </div>
                                                        </div>
                                                        <button id="+opc_1" type="button" onClick="agregarOpcion('Pregunta_{{$i}}_{{$j}}_{{$k}}',false)">Añadir opción</button>
                                                    </div>
                                                    <input id="res_Pregunta_{{$i}}_{{$j}}_{{$k}}" type="text" value="Respuesta" disabled @if($pregunta->tipo != 3) hidden @endif></input>
                                                </div>
                                                @foreach($subpreguntas[$i-1][$j-1][$k-1] as $subpregunta)
                                                <div id="{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" class="card">
                                                <div class="card-header">
                                                    <label>{{$k}}.{{$l}}.</label>
                                                    <input type="hidden" name="id_subpreguntas[{{$i-1}}][{{$j-1}}][{{$k-1}}][]" value = "{{$subpregunta->id}}">
                                                    <input type="text" value = "{{$subpregunta->descripcion}}" name="subpreguntas[{{$i-1}}][{{$j-1}}][{{$k-1}}][]" placeholder="Subregunta"></input>
                                                    <select id="tipo_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" name="tipos_sub[{{$i-1}}][{{$j-1}}][{{$k-1}}][]" onChange="cambiarTipo('{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}')">
                                                        <option @if($subpregunta->tipo == 0) selected @endif value="0">Cierto o falso</option>
                                                        <option @if($subpregunta->tipo == 1) selected @endif value="1">Opción múltiple</option>
                                                        <option @if($subpregunta->tipo == 2) selected @endif value="2">Selección múltiple</option>
                                                        <option @if($subpregunta->tipo == 3) selected @endif value="3">Abierta</option>
                                                    </select>
                                                </div>
                                                <div class="card-body">
                                                    <div id="ciertoFalso_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" @if($subpregunta->tipo != 0) hidden @endif>
                                                        <input type="radio" disabled></input>
                                                        <label>Cierto</label>
                                                        <input type="radio" disabled></input>
                                                        <label>Falso</label>
                                                    </div>
                                                    <div id="opcionMultiple_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}"  @if($subpregunta->tipo != 1 && $subpregunta->tipo != 2) hidden @endif>
                                                        <div id="opciones_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" opciones="[{{$i-1}}][{{$j-1}}][{{$k-1}}][{{$l-1}}][]">
                                                            <div style="display: flex; margin-top: 10px;">
                                                                @if($subpregunta->tipo == 1 || $subpregunta->tipo == 2)
                                                                <?php $n_subopcion = 1; ?>
                                                                @foreach($subpregunta->opciones as $opcion)
                                                                    <input type="radio" disabled></input>
                                                                    <input id="{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}_opc-{{$n_subopcion}}" name="subopciones[{{$i-1}}][{{$j-1}}][{{$k-1}}][{{$l-1}}][]" type=text value="{{$opcion}}" placeholder="Opción 1"></input>
                                                                    <?php $n_opcion++; ?>
                                                                @endforeach
                                                            @else
                                                                <input type="radio" disabled></input>
                                                                <input id="{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}_opc-1" name="subopciones[{{$i-1}}][{{$j-1}}][{{$k-1}}][{{$l-1}}][]" type=text placeholder="Opción 1"></input>
                                                            @endif
                                                            </div>
                                                        </div>
                                                        <button id="+opc_1" type="button" onClick="agregarOpcion('{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}',true)">Añadir opción</button>
                                                    </div>
                                                    <input id="res_{{$i}}_{{$j}}_{{$k}}_SubPregunta_{{$l}}" type="text" value="Respuesta" disabled @if($subpregunta->tipo != 3) hidden @endif></input>
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

                            <div style="display: flex;justify-content: right;align-items: center;">

                                <button
                                    id="btnAgregarCategoria"
                                    type="button"
                                    onClick="agregarCategoria()"
                                    class="btn btn-primary"
                                    style="margin-right: 20px;">
                                    Agregar categoria
                                </button>
                                <button
                                    id="btnGuardar"
                                    type="submit"
                                    class="btn btn-success">
                                    Guardar
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>

<script type="application/javascript" src="{{ asset('js/Plantilla/edicion_plantilla.js') }}"></script>

@endsection

