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

    <form action="/cuestionarios/update/{{ $cuestionario->id }}" method="POST" enctype="multipart/form-data">
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
                  <div id="categoria_{{ $i }}"
                    style="
                                    border: 1px solid gray;
                                    border-radius: 10px;
                                    padding: 20px;
                                    margin: 10px;
                                    ">
                    <div class="row col-7">
                      <label class="form-label">
                        <h5>{{ $categoria->descripcion }}</h5>
                      </label>
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
                          <label class="form-label">
                            <h5>{{ $subcategoria->descripcion }}</h5>
                          </label>
                        </div>

                        <div id="preguntas_{{ $i }}_{{ $j }}">

                          @foreach ($preguntas[$i - 1][$j - 1] as $pregunta)
                            <?php
                            $l = 1;
                            ?>
                            <div id="Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                              ultimaSubpreguntaId={{ count($subpreguntas[$i - 1][$j - 1][$k - 1]) }}>

                              <div class="row" style="margin-bottom: 10px;">
                                <label class="form-check-label col-sm" style="margin-bottom: 10px;">{{ $k }}.
                                  {{ $pregunta->descripcion }} </label>
                                {{-- name="preguntas[{{$i-1}}][{{$j-1}}][]" --}}
                              </div>

                              @if ($pregunta->evidencia == 1)
                                <label class="form-check-label col-sm"
                                  style="margin-bottom: 10px;">{{ $pregunta->descripcion_evidencia }}</label>
                                <div
                                  id="evidencia_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                  style="margin-top: 10px;">
                                  <label class="form-label">Evidencia</label>
                                  <input name="evidencias[{{ $i - 1 }}][{{ $j - 1 }}][]" type="file"
                                    class="form-control" />
                                </div>
                              @endif

                              @if ($pregunta->adjunto == 1)
                                <a class="btn btn-primary form-check-label col-sm-2" href="{{ URL($adjuntos_pregunta[$i-1][$j-1][$k-1]->archivo)}}"  
                                  style="margin-bottom: 10px;" download>Descargar adjunto
                                  <i class="fas fa-download"  title="Descargar adjunto"
                                  data-bs-placement="right"></i></a>
                              @endif


                              <div class="card-body" style="padding-top: 0px">
                                <input hidden name="ids_Pregunta[]" value={{ $pregunta->id }}>
                                @if ($pregunta->tipo == 0)
                                  <div
                                    id="ciertoFalso_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                    class="form-check">
                                    <div>
                                      <input class="form-check-input" name="res_pregunta_{{ $pregunta->id }}"
                                        id="ciertoFalso_{{ $i }}_{{ $j }}_{{ $k }}_cierto"
                                        value="1" 
                                        @isset($respuestasPregunta[$pregunta->id])
                                        @if ($respuestasPregunta[$pregunta->id] == 1) checked @endif 
                                        @endisset
                                        type="radio">
                                      </input>
                                      <label class="form-check-label">
                                        Cierto
                                      </label>

                                    </div>
                                    <div>
                                      <input class="form-check-input" name="res_pregunta_{{ $pregunta->id }}"
                                        id="ciertoFalso_{{ $i }}_{{ $j }}_{{ $k }}_falso"
                                        value="0" 
                                        @isset($respuestasPregunta[$pregunta->id])
                                        @if ($respuestasPregunta[$pregunta->id] == 0) checked @endif
                                        @endisset
                                         type="radio">
                                      </input>
                                      <label class="form-check-label">
                                        Falso
                                      </label>
                                    </div>
                                  </div>
                                @endif
                                @if ($pregunta->tipo == 1)
                                  <div
                                    id="opcionMultiple_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}">

                                    <div
                                      id="opciones_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                      opciones="[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                      style="margin-bottom: 10px;">
                                      <?php $n_opcion = 1; ?>
                                      @foreach ($pregunta->opciones as $opcion)
                                        <div style="display: flex; margin-top: 10px;">
                                          <input type="radio" name="res_pregunta_{{ $pregunta->id }}"
                                            id="radio_{{ $i }}_{{ $j }}_{{ $k }}_opc-{{ $n_opcion }}"
                                            value="{{ $n_opcion }}" 
                                            @isset($respuestasPregunta[$pregunta->id])
                                            @if ($respuestasPregunta[$pregunta->id] == $n_opcion) checked @endif
                                            @endisset
                                            class="form-check-input"></input>
                                          <label class="form-check-label col-sm"
                                            name="opciones[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                            class="form-control col-3">{{ $opcion }}
                                          </label>
                                        </div>
                                        <?php $n_opcion++; ?>
                                      @endforeach
                                    </div>
                                  </div>
                                @endif
                                @if ($pregunta->tipo == 2)
                                  <div
                                    id="opcionMultiple_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}">

                                    <div
                                      id="opciones_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                      opciones="[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                      style="margin-bottom: 10px;">
                                      <?php $n_opcion = 1; ?>
                                      @foreach ($pregunta->opciones as $opcion)
                                        <div
                                          id="Pregunta_{{ $i }}_{{ $j }}_{{ $k }}_opc-{{ $n_opcion }}"
                                          style="display: flex; margin-top: 10px;">
                                          <input type="radio" class="form-check-input"></input>
                                          <label class="form-check-label col-sm"
                                            name="opciones[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                            class="form-control col-3">{{ $opcion }}
                                          </label>
                                        </div>
                                        <?php $n_opcion++; ?>
                                      @endforeach
                                    </div>
                                  </div>
                                @endif
                                @if ($pregunta->tipo == 3)
                                  <input id="res_Pregunta_{{ $i }}_{{ $j }}_{{ $k }}"
                                    name="res_pregunta_{{ $pregunta->id }}" type="text"
                                    @isset($respuestasPregunta[$pregunta->id])
                                    value={{ $respuestasPregunta[$pregunta->id] }} 
                                    @endisset
                                    class="form-control col-6">
                                  </input>
                                @endif

                              </div>

                              @foreach ($subpreguntas[$i - 1][$j - 1][$k - 1] as $subpregunta)
                                <input hidden name="ids_subpregunta[]"value={{ $subpregunta->id }}>
                                <div
                                  id="{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}">

                                  <div class="row" style="margin-bottom: 10px;">
                                    <label class="form-check-label col-sm"
                                      style="margin-bottom: 10px;">{{ $k }}.{{ $l }}.
                                      {{ $subpregunta->descripcion }}</label>
                                  </div>

                                  <div class="card-body" style="display: flex; align-items: center;padding-top: 0px">

                                    @if ($subpregunta->tipo == 0)
                                      <div
                                        id="ciertoFalso_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                        class="form-check">
                                        <div>
                                          <input class="form-check-input" name="res_subpregunta_{{ $subpregunta->id }}"
                                            id="ciertoFalso_{{ $i }}_{{ $j }}_{{ $k }}_{{ $l }}_cierto"
                                            value="1" @if ($respuestasSubpregunta[$subpregunta->id] == 1) checked @endif
                                            type="radio">
                                          </input>
                                          <label class="form-check-label">
                                            Cierto
                                          </label>

                                        </div>
                                        <div>
                                          <input class="form-check-input" name="res_subpregunta_{{ $subpregunta->id }}"
                                            id="ciertoFalso_{{ $i }}_{{ $j }}_{{ $k }}_{{ $l }}_falso"
                                            value="0"
                                            @isset($respuestasSubpregunta[$subpregunta->id])
                                            @if ($respuestasSubpregunta[$subpregunta->id] == 0) checked @endif 
                                          @endisset
                                            type="radio">
                                          </input>
                                          <label class="form-check-label">
                                            Falso
                                          </label>
                                        </div>
                                      </div>
                                    @endif
                                    @if ($subpregunta->tipo == 1)
                                      <div>
                                        <div
                                          id="opciones_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                          opciones="[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                          style="margin-bottom: 10px;">
                                          <?php $n_subopcion = 1; ?>
                                          @foreach ($subpregunta->opciones as $opcion)
                                            <div
                                              id="Pregunta_{{ $i }}_{{ $j }}_{{ $k }}_opc-{{ $n_subopcion }}"
                                              style="display: flex; margin-top: 10px;">
                                              <input type="radio" name="res_subpregunta_{{ $subpregunta->id }}"
                                                id="radio_{{ $i }}_{{ $j }}_{{ $k }}_{{ $l }}_opc-{{ $n_subopcion }}"
                                                value="{{ $n_subopcion }}"
                                                @isset($respuestasSubpregunta[$subpregunta->id])
                                              @if ($respuestasSubpregunta[$subpregunta->id] == $n_subopcion) checked @endif 
                                              @endisset
                                                class="form-check-input"></input>
                                              <label class="form-check-label col-sm"
                                                name="opciones[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                                class="form-control col-3">{{ $opcion }}
                                              </label>
                                            </div>
                                            <?php $n_subopcion++; ?>
                                          @endforeach
                                        </div>
                                      </div>
                                    @endif
                                    @if ($subpregunta->tipo == 2)
                                      <div>
                                        <div
                                          id="opciones_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                          opciones="[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                          style="margin-bottom: 10px;">
                                          <?php $n_subopcion = 1; ?>
                                          @foreach ($subpregunta->opciones as $opcion)
                                            <div
                                              id="Pregunta_{{ $i }}_{{ $j }}_{{ $k }}_opc-{{ $n_subopcion }}"
                                              style="display: flex; margin-top: 10px;">
                                              <input type="radio" class="form-check-input"></input>
                                              <label class="form-check-label col-sm"
                                                name="opciones[{{ $i - 1 }}][{{ $j - 1 }}][{{ $k - 1 }}][]"
                                                class="form-control col-3">{{ $opcion }}
                                              </label>
                                            </div>
                                            <?php $n_subopcion++; ?>
                                          @endforeach
                                        </div>
                                      </div>
                                    @endif
                                    @if ($subpregunta->tipo == 3)
                                      <input
                                        id="res_{{ $i }}_{{ $j }}_{{ $k }}_SubPregunta_{{ $l }}"
                                        name="res_subpregunta_{{ $subpregunta->id }}" type="text"
                                        @isset($respuestasSubpregunta[$subpregunta->id])
                                        value={{ $respuestasSubpregunta[$subpregunta->id] }}
                                        @endisset
                                        class="form-control col-6">
                                      </input>
                                    @endif

                                  </div>

                                </div>
                                <?php
                                $l++;
                                ?>
                              @endforeach

                            </div>
                            <?php
                            $k++;
                            ?>
                          @endforeach
                        </div>

                      </div>
                      <?php
                      $j++;
                      ?>
                    @endforeach
                  </div>

                  <?php
                  $i++;
                  ?>
                @endforeach
              </div>

              <div style="display: flex;justify-content: right;align-items: center;">
                <button id="btnGuardar" type="submit" class="btn btn-success">
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
