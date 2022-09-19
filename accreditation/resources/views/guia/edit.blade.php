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
            <li class="breadcrumb-item"><a class="fw-light" href="/plantillas"
                style="text-decoration: none;">Plantillas</a></li>
            <li class="breadcrumb-item active fw-light" aria-current="page"> Guia </li>
          </ol>
        </nav>
      </div>
    </div>

    <form action="/guia/update/{{ $guia->id }}" method="POST">
      @csrf
      @method('put')
      <div class="card" style="text-align: center;">
        <div class="card-header">
          <h4>{{ $guia->programasEducativos->nombre }} - {{ $guia->programasEducativos->nivel }}</h4>
        </div>
      </div>

      <div class="card">
        <div class="card card-nav-tabs card-plain">
          <div class="card-header header-table">
            <div class="card-body">

              <div id="categorias" style=" margin-bottom: 20px;">
                @foreach ($categorias as $categoria)
                  <?php
                  $j = 1;
                  ?>
                  <div id="categoria_{{ $i }}">
                    <div class="row col-7">
                      <label class="col-sm-3 form-label">
                        <h5>Categoría</h5>
                      </label>
                      <div class="col-sm-9">
                        <input type="hidden" name="id_categorias[]" value="{{ $categoria->id }}">
                        <input class="form-control col-6" type="text" name="categorias[]"
                          value="{{ $categoria->descripcion }}" placeholder="Categoría">
                      </div>
                    </div>
                    @foreach ($subcategorias[$i - 1] as $subcategoria)
                      <?php
                      $k = 1;
                      ?>
                      <div id="subCategoria_{{ $i }}_{{ $j }}"
                        style="
                                            margin-top: 10px;
                                            border: 1px solid gray;
                                            border-radius: 10px;
                                            padding: 20px;
                                            margin: 10px;">

                        <div class="row col-7">
                          <label class="col-sm-3 form-label">
                            <h5>Subcategoría</h5>
                          </label>
                          <div class="col-sm-9">
                            <input type="hidden" name="id_subcategorias[{{ $i - 1 }}][]"
                              value="{{ $subcategoria->id }}">
                            <input class="form-control col-6" type="text" value="{{ $subcategoria->descripcion }}"
                              name="subcategorias[{{ $i - 1 }}][]" placeholder="Subcategoría">
                          </div>
                        </div>

                        <div id="preguntas_{{ $i }}_{{ $j }}"
                          style="
                                            border: 1px solid gray;
                                            border-radius: 10px;
                                            padding: 20px;
                                            margin: 10px;
                                            ">

                          @foreach ($preguntas[$i - 1][$j - 1] as $pregunta)
                            <?php
                            $l = 1;
                            ?>
                            <div id="Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                              ultimaSubpreguntaId={{ count($subpreguntas[$i - 1][$j - 1][$k - 1]) }}>

                              <div class="row" style="margin-bottom: 10px;">
                                <label class="form-check-label col-sm" style="margin-bottom: 10px;">{{ $k }}.
                                  Pregunta </label>
                                <div>
                                  <input type="hidden" name="id_preguntas[{{ $i - 1 }}][{{ $j - 1 }}][]"
                                    value="{{ $pregunta->id }}">
                                  <input type="text" value="{{ $pregunta->descripcion }}"
                                    name="preguntas[{{ $i - 1 }}][{{ $j - 1 }}][]"
                                    placeholder="Agregar Pregunta" class="form-control col-12">
                                  </input>
                                </div>
                              </div>

                              <div style="display: flex; align-items: center;">

                                <label class="form-check-label" style="margin-right: 20px;">Tipo de Pregunta </label>
                                <div style="margin-right: 20px;">

                                  <select
                                    id="tipo_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                    name="tipos[{{ $i - 1 }}][{{ $j - 1 }}][]"
                                    onChange="cambiarTipo('Pregunta_{{ $i }}_{{ $j }}_{{ $k }}')"
                                    class="form-select">
                                    <option @if ($pregunta->tipo == 0) selected @endif value="0">Cierto o
                                      falso</option>
                                    <option @if ($pregunta->tipo == 1) selected @endif value="1">Opción
                                      múltiple</option>
                                    {{-- <option @if ($pregunta->tipo == 2) selected @endif value="2">Selección múltiple</option> --}}
                                    <option @if ($pregunta->tipo == 3) selected @endif value="3">Abierta
                                    </option>
                                    <option @if ($pregunta->tipo == 4) selected @endif value="4">Subpreguntas
                                    </option>
                                  </select>
                                </div>

                                <div class="form-check">
                                  <input id=check_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}
                                    type="checkbox" @if ($pregunta->evidencia == 1) checked @endif
                                    onChange="habilitarEvidencia('Pregunta_{{ $i }}_{{ $j }}_{{ $k }}')"
                                    class="form-check-input">
                                  </input>
                                  <label class="form-check-label" for="check_Pregunta_1_1_1">
                                    Agregar Evidencia
                                  </label>
                                </div>

                                <div style="margin: 10px 0px 10px 52px;">
                                  <textarea id=evidencia_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}
                                    name="evidencias[{{ $i - 1 }}][{{ $j - 1 }}][]" placeholder="Agregar descripción de evidencia"
                                    @if ($pregunta->evidencia == 0) hidden @endif class="form-control" cols="80">
                                                            {{ $pregunta->descripcion_evidencia }}
                                                        </textarea>
                                </div>
                              </div>


                              <div id="adjunto_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                style="margin-top: 10px;">
                                <label class="form-label">Adjunto archivo</label>
                                <input name="adjuntos[{{ $i - 1 }}][{{ $j - 1 }}][]" type="file"
                                  class="form-control" />
                              </div>

                              <div id="Cuerpo_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                class="card-body">

                                <div
                                  id="ciertoFalso_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                  @if ($pregunta->tipo != 0) hidden @endif class="form-check">
                                  <div>
                                    <input class="form-check-input" type="radio" disabled>
                                    </input>
                                    <label class="form-check-label">
                                      Cierto
                                    </label>

                                  </div>
                                  <div>
                                    <input class="form-check-input" type="radio" disabled>
                                    </input>
                                    <label class="form-check-label">
                                      Falso
                                    </label>
                                  </div>
                                </div>

                                <div
                                  id="opcionMultiple_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                  @if ($pregunta->tipo != 1 && $pregunta->tipo != 2) hidden @endif>

                                  <div
                                    id="opciones_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                    opciones="[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                    style="margin-bottom: 10px;">


                                    @if ($pregunta->tipo == 1 || $pregunta->tipo == 2)
                                      <?php $n_opcion = 1; ?>
                                      @foreach ($pregunta->opciones as $opcion)
                                        <div
                                          id="Pregunta_{{ $i }}_{{ $j }}_{{ $k }}_opc-{{ $n_opcion }}"
                                          style="display: flex; margin-top: 10px;">
                                          @if ($n_opcion == 1)
                                            <input type="radio" class="form-check-input" disabled></input>
                                          @else
                                            <button class="btn btn-outline-danger" type="button"
                                              onclick="eliminarOpcion('Pregunta_{{ $i }}_{{ $j }}_{{ $k }}',{{ $n_opcion }})">X
                                            </button>
                                          @endif
                                          <input
                                            name="opciones[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                            type="text" value="{{ $opcion }}"
                                            placeholder="Opción {{ $n_opcion }}" class="form-control col-3">
                                          </input>
                                        </div>
                                        <?php $n_opcion++; ?>
                                      @endforeach
                                    @else
                                      <input type="radio" class="form-check-input" disabled></input>
                                      <input
                                        id="Pregunta_{{ $i }}_{{ $j }}_{{ $k }}_opc-1"
                                        name="opciones[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                        type="text" placeholder="Opción 1" class="form-control col-3">
                                      </input>
                                    @endif

                                  </div>

                                  <button id="+opc_1" type="button"
                                    onClick="agregarOpcion('Pregunta_{{ $i }}_{{ $j }}_{{ $k }}',false)"
                                    class="btn btn-primary">
                                    <i class="fa fa-plus" aria-hidden="true" data-bs-toggle="tooltip"
                                      title="Agregar opción" data-bs-placement="right"></i>
                                    Añadir opción
                                  </button>

                                </div>

                                <input id="res_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                  type="text" value="Respuesta" class="form-control col-6" disabled
                                  @if ($pregunta->tipo != 3) hidden @endif>
                                </input>
                                <hr />

                                <div
                                  id="Subpreguntas_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                  @if ($pregunta->tipo != 4) hidden @endif>
                                  @foreach ($subpreguntas[$i - 1][$j - 1][$k - 1] as $subpregunta)
                                    <div
                                      id="{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}">

                                      <div class="row" style="margin-bottom: 10px;">
                                        <label class="form-check-label col-sm"
                                          style="margin-bottom: 10px;">{{ $k }}.{{ $l }}.
                                          Subpregunta</label>
                                        <div>
                                          <input type="hidden"
                                            name="id_subpreguntas[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                            value="{{ $subpregunta->id }}">
                                          <input type="text" value="{{ $subpregunta->descripcion }}"
                                            name="subpreguntas[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                            placeholder="Subregunta" class="form-control col-12">
                                          </input>
                                        </div>

                                      </div>

                                      <div style="display: flex; align-items: center;">

                                        <label class="form-check-label" style="margin-right: 20px;">Tipo de Subpregunta
                                        </label>

                                        <div style="margin-right: 20px;">
                                          <select
                                            id="tipo_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                            name="tipos_sub[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                            onChange="cambiarTipo('{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}')"
                                            class="form-select">
                                            <option @if ($subpregunta->tipo == 0) selected @endif value="0">
                                              Cierto o falso</option>
                                            <option @if ($subpregunta->tipo == 1) selected @endif value="1">
                                              Opción múltiple</option>
                                            {{-- <option @if ($subpregunta->tipo == 2) selected @endif value="2">Selección múltiple</option> --}}
                                            <option @if ($subpregunta->tipo == 3) selected @endif value="3">
                                              Abierta</option>
                                          </select>
                                        </div>

                                      </div>

                                      <div class="card-body">

                                        <div
                                          id="ciertoFalso_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                          @if ($subpregunta->tipo != 0) hidden @endif class="form-check">
                                          <div>
                                            <input class="form-check-input" type="radio" disabled></input>
                                            <label class="form-check-label">Cierto</label>
                                          </div>
                                          <div>
                                            <input class="form-check-input" type="radio" disabled></input>
                                            <label class="form-check-label">Falso</label>
                                          </div>
                                        </div>

                                        <div
                                          id="opcionMultiple_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                          @if ($subpregunta->tipo != 1 && $subpregunta->tipo != 2) hidden @endif>

                                          <div
                                            id="opciones_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                            opciones="[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][{{ $l - 1 }}][]"
                                            style="margin-bottom: 10px;">


                                            @if ($subpregunta->tipo == 1 || $subpregunta->tipo == 2)
                                              <?php $n_subopcion = 1; ?>
                                              @foreach ($subpregunta->opciones as $opcion)
                                                <div
                                                  id="{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}_opc-{{ $n_subopcion }}"
                                                  style="display: flex; margin-top: 10px;">
                                                  @if ($n_subopcion == 1)
                                                    <input type="radio" class="form-check-input" disabled></input>
                                                  @else
                                                    <button class="btn btn-outline-danger" type="button"
                                                      onclick="eliminarOpcion('{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}',{{ $n_subopcion }})">X
                                                    </button>
                                                  @endif

                                                  <input
                                                    name="subopciones[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][{{ $l - 1 }}][]"
                                                    type=text value="{{ $opcion }}"
                                                    placeholder="Opción {{ $n_subopcion }}"
                                                    class="form-control col-3">
                                                  </input>
                                                </div>
                                                <?php $n_subopcion++; ?>
                                              @endforeach
                                            @else
                                              <input type="radio" class="form-check-input" disabled></input>
                                              <input
                                                id="{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}_opc-1"
                                                name="subopciones[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][{{ $l - 1 }}][]"
                                                type=text placeholder="Opción 1" class="form-control col-3">
                                              </input>
                                            @endif

                                          </div>

                                          <button id="+opc_1" type="button"
                                            onClick="agregarOpcion('{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}',true)"
                                            class="btn btn-primary">
                                            <i class="fa fa-plus" aria-hidden="true" data-bs-toggle="tooltip"
                                              title="Agregar opción" data-bs-placement="right"></i>
                                            Añadir opción
                                          </button>

                                        </div>

                                        <input
                                          id="res_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                          type="text" value="Respuesta" class="form-control col-6" disabled
                                          @if ($subpregunta->tipo != 3) hidden @endif>
                                        </input>
                                        <hr />

                                      </div>
                                    </div>
                                    <?php
                                    $l++;
                                    ?>
                                  @endforeach

                                  <button id="Boton_{{ $i }}_{{ $j }}_{{ $k }}"
                                    type="button"
                                    onClick="agregarSubPregunta({{ $i }},{{ $j }},{{ $k }})"
                                    class="btn btn-primary" style="margin-bottom: 10px;">
                                    <i class="fa fa-plus" aria-hidden="true" data-bs-toggle="tooltip"
                                      title="Agregar Subpregunta" data-bs-placement="right"></i>
                                    Agregar Subpregunta
                                  </button>
                                  <div>
                                  </div>
                                </div>
                                <?php
                                $k++;
                                ?>
                          @endforeach
                        </div>



                      </div>
                  </div>
                  <button id="buttonAgregar_{{ $i }}_{{ $j }}" type="button"
                    onClick="agregarPregunta({{ $i }},{{ $j }})" class="btn btn-primary"
                    style="margin-left: 10px;">
                    Agregar pregunta
                  </button>
                  <?php
                  $j++;
                  ?>
                @endforeach

              </div>
            </div>
            <button id="btnAgregarSubcategoria_{{ $i }}" type="button"
                onClick="agregarSubcategoria({{ $i }})" class="btn btn-primary"
                style="margin-left: 10px;">
                Agregar Subcategoría
              </button>
              <hr />
              <?php
              $i++;
              ?>
              @endforeach
          </div>

          <div id="botones" style="display: flex;justify-content: right;align-items: center;">

            <button id="btnAgregarCategoria" type="button" onClick="agregarCategoria()" class="btn btn-primary"
              style="margin-right: 20px;">
              Agregar categoría
            </button>
            <button id="btnGuardar" type="submit" class="btn btn-success">
              Guardar
            </button>

          </div>
        </div>
      </div>
    </form>
  </div>

  <script type="application/javascript" src="{{ asset('js/Plantilla/edicion_plantilla.js') }}"></script>
@endsection
