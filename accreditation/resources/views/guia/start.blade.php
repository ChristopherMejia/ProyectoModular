@extends('layouts.app')
@section('content')

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

    <form action="/guia/update/{{$guia->id}}" method="POST">
    @csrf
    @method('put')
    <div class="card" style="text-align: center;">
        <div class="card-header"><h4>{{ $guia->programasEducativos->nombre }} - {{ $guia->programasEducativos->nivel }}</h4></div>
    </div>

    <div class="card">
        <div class="card card-nav-tabs card-plain">
            <div class="card-header header-table">

                <div class="card-body">
                    <form id="form_guardar_plantilla" action="#" method="POST" class="form-horizontal">

                        <div id="categorias" style=" margin-bottom: 20px;">

                            <div id="categoria_1" >

                                <div class="row col-7">
                                    <label for="categorias[]" class="col-sm-3 form-label" ><h5>Categoría</h5></label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="id_categorias[]">
                                        <input type="text" name="categorias[]" class="form-control col-6" placeholder="Nombre de la categoría">
                                    </div>
                                </div>

                                <div
                                    id="subCategoria_1_1"
                                    style="
                                        margin-top: 10px;
                                        border: 1px solid gray;
                                        border-radius: 10px;
                                        padding: 20px;
                                        margin: 10px;" >

                                    <div class="row col-7" >
                                        <label for="subcategorias[0][]" class="col-sm-3 form-label" ><h5>Subcategoría</h5></label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="id_subcategorias[0][]">
                                            <input type="text" name="subcategorias[0][]"  class="form-control col-6" placeholder="Nombre de la Subcategoría">
                                        </div>
                                    </div>

                                    <div
                                        id="preguntas_1_1"
                                        style="
                                            border: 1px solid gray;
                                            border-radius: 10px;
                                            padding: 20px;
                                            margin: 10px;
                                        ">
                                        <div id="Pregunta_1_1_1" ultimaSubpreguntaId=0>

                                            <div class="row" style="margin-bottom: 10px;">
                                                <label
                                                    class="form-check-label col-sm"
                                                    style="margin-bottom: 10px;">
                                                    1. Pregunta
                                                </label>

                                                <div>
                                                    <input type="hidden" name="id_preguntas[0][0][]">
                                                    <input
                                                        type="text"
                                                        name="preguntas[0][0][]"
                                                        placeholder="Agregar Pregunta"
                                                        class="form-control col-12">
                                                    </input>
                                                </div>
                                            </div>

                                            <div style="
                                                display: flex;
                                                align-items: center;">

                                                <label class="form-check-label" style="margin-right: 20px;" >Tipo de Pregunta </label>

                                                <div style="margin-right: 20px;">
                                                    <select
                                                        id="tipo_Pregunta_1_1_1"
                                                        name="tipos[0][0][]"
                                                        value="Pregunta"
                                                        onChange="cambiarTipo('Pregunta_1_1_1')"
                                                        class="form-select">
                                                        <option value="0">Cierto o falso</option>
                                                        <option value="1">Opción múltiple</option>
                                                        <option value="2">Selección múltiple</option>
                                                        <option value="3">Abierta</option>
                                                    </select>
                                                </div>


                                                <div class="form-check">
                                                    <input
                                                        id=check_Pregunta_1_1_1
                                                        type="checkbox"
                                                        onChange="habilitarEvidencia('Pregunta_1_1_1')"
                                                        class="form-check-input"/>
                                                    <label class="form-check-label" for="check_Pregunta_1_1_1">
                                                        Agregar Evidencia
                                                    </label>
                                                </div>

                                                <div style="margin: 10px 0px 10px 52px;">
                                                     {{-- área de texto para la descripcion de la evidencia  --}}
                                                    <textarea
                                                        id=evidencia_Pregunta_1_1_1
                                                        name="evidencias[0][0][]"
                                                        placeholder="Agregar descripción de evidencia"
                                                        class="form-control"
                                                        cols="80"
                                                        hidden>
                                                    </textarea>
                                                </div>

                                            </div>


                                            <div id="adjunto_Pregunta_1_1_1" style="margin-top: 10px;">
                                                <label for="formFile" class="form-label">Adjuntar archivo</label>
                                                <input id="formFile" name="adjuntos[0][0][]" type="file" class="form-control"></input>
                                            </div>

                                            <div class="card-body">

                                                <div id="ciertoFalso_Pregunta_1_1_1" class="form-check">
                                                    <div >

                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="radioCierto"
                                                            id="radioCierto1"
                                                            disabled>
                                                        </input>
                                                        <label
                                                            class="form-check-label"
                                                            for="radioCierto1">
                                                            Cierto
                                                        </label>

                                                    </div>

                                                    <div >

                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            name="radioFalso"
                                                            id="radioFalso1"
                                                            type="radio"
                                                            disabled>
                                                        </input>
                                                        <label
                                                            class="form-check-label"
                                                            for="radioFalso1">
                                                            Falso
                                                        </label>
                                                    </div>

                                                </div>

                                                <div id="opcionMultiple_Pregunta_1_1_1" hidden=true>

                                                    <div id="opciones_Pregunta_1_1_1" style="margin-bottom: 10px;" opciones="[0][0][0][]">
                                                        <input
                                                            class="form-check-input"
                                                            type="radio"
                                                            disabled />
                                                        <input
                                                            id=Pregunta_1_1_1_opc-1
                                                            name=opciones[0][0][0][]
                                                            type=text
                                                            placeholder="Opción 1"
                                                            class="form-control col-3"
                                                            >
                                                        </input>
                                                    </div>

                                                    <button
                                                        id="+opc_1"
                                                        type="button"
                                                        onClick="agregarOpcion('Pregunta_1_1_1',false)"
                                                        class="btn btn-primary"
                                                        >
                                                        <i class="fa fa-plus" aria-hidden="true"
                                                            data-bs-toggle="tooltip"
                                                            title="Agregar opción"
                                                            data-bs-placement="right"
                                                        ></i>
                                                        Opción
                                                    </button>

                                                </div>

                                                <input
                                                    id="res_Pregunta_1_1_1"
                                                    type="text"
                                                    value="Respuesta"
                                                    class="form-control col-6"
                                                    disabled
                                                    hidden=true>
                                                </input>
                                                <hr />


                                            </div>

                                            <button
                                                id="Boton_1_1_1"
                                                type="button"
                                                onClick="agregarSubPregunta(1,1,1)"
                                                class="btn btn-primary"
                                                style="margin-bottom: 10px;"
                                                >
                                                <i
                                                    class="fa fa-plus"
                                                    aria-hidden="true"
                                                    data-bs-toggle="tooltip"
                                                    title="Agregar Subpregunta"
                                                    data-bs-placement="right"
                                                ></i>
                                                Subpregunta
                                            </button>
                                            <hr />
                                        </div>


                                    </div>
                                    {{-- Boton para agregar pregunta --}}
                                    <button
                                        id="buttonAgregar_1_1"
                                        type="button"
                                        onClick="agregarPregunta(1,1)"
                                        class="btn btn-primary"
                                        style="margin-left: 10px;"
                                        >
                                        Agregar Pregunta
                                    </button>

                                </div>

                            </div>

                             {{-- Boton para agregar Subcategoría --}}
                            <button
                                id="btnAgregarSubcategoria_1"
                                type="button"
                                onClick="agregarSubcategoria(1)"
                                class="btn btn-primary"
                                style="margin-left: 10px;"
                                >

                                Agregar Subcategoría
                            </button>
                        </div>

                        <div style="display: flex;justify-content: right;align-items: center;">

                            <button
                                id="btnAgregarCategoria"
                                type="button"
                                onClick="agregarCategoria()"
                                class="btn btn-primary"
                                style="margin-right: 20px;"
                                >
                                Agregar Categoría
                            </button>

                            <button
                                id="btnGuardar"
                                type="submit"
                                class="btn btn-success">
                                Guardar
                            </button>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>




</div>

<script type="application/javascript" src="{{ asset('js/Plantilla/edicion_plantilla.js') }}"></script>
@endsection

