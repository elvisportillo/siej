@include("layouts.app")
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="d-flex justify-content-center ">

        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button class="nav-link active" id="v-pills-criterio-uno-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-uno" type="button" role="tab" aria-controls="v-pills-criterio-uno" aria-selected="true">Criterio Uno</button>
          <button class="nav-link" id="v-pills-criterio-dos-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-dos" type="button" role="tab" aria-controls="v-pills-criterio-dos" aria-selected="false">Criterio Dos</button>
          <button class="nav-link" id="v-pills-criterio-tres-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-tres" type="button" role="tab" aria-controls="v-pills-criterio-tres" aria-selected="false">Criterio Tres</button>
          <button class="nav-link" id="v-pills-criterio-cuatro-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-cuatro" type="button" role="tab" aria-controls="v-pills-criterio-cuatro" aria-selected="false">Criterio Cuatro</button>
          <button class="nav-link" id="v-pills-criterio-cinco-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-cinco" type="button" role="tab" aria-controls="v-pills-criterio-cinco" aria-selected="false">Criterio Cinco</button>
          <button class="nav-link" id="v-pills-criterio-seis-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-seis" type="button" role="tab" aria-controls="v-pills-criterio-seis" aria-selected="false">Criterio Seis</button>
          <button class="nav-link" id="v-pills-criterio-siete-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-siete" type="button" role="tab" aria-controls="v-pills-criterio-siete" aria-selected="false">Criterio Siete</button>
          <button class="nav-link" id="v-pills-criterio-ocho-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-ocho" type="button" role="tab" aria-controls="v-pills-criterio-ocho" aria-selected="false">Criterio Ocho</button>
          <button class="nav-link" id="v-pills-criterio-nueve-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-nueve" type="button" role="tab" aria-controls="v-pills-criterio-nueve" aria-selected="false">Criterio Nueve</button>
          <button class="nav-link" id="v-pills-criterio-diez-tab" data-bs-toggle="pill" data-bs-target="#v-pills-criterio-diez" type="button" role="tab" aria-controls="v-pills-criterio-diez" aria-selected="false">Criterio Diez</button>
        </div>

        
        <form id="form-criterios" method="post" action="{{ url('guardarCriterioEPA1') }}">
        <div class="tab-content" id="v-pills-tabContent">
          
          <div class="tab-pane fade show active" id="v-pills-criterio-uno" role="tabpanel" aria-labelledby="v-pills-criterio-uno-tab">
            @csrf

            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE LA SEDE JUDICIAL</p>
                <p class="criterio">CRITERIO UNO:</p>

                <div class="row">
                  <p class="subcriterio col-sm-10">Asistencia Puntual y Disciplina del Funcionario/a y del Personal en Horas de la Jornada Laboral</p>
                  <div class="form-check form-switch col-sm-2">
                      <input type="checkbox" class="form-check-input" name="evaluado_criterio_1" id="evaluado_criterio_1" checked>
                      <label class="form-check-label" for="evaluado_criterio_1">Evaluable</label>
                  </div>
                </div>
                
                <hr>

                <div class="row mb-3 mt-3">
                  
                  <div class="col-sm-9">
                    1.1 Asistencia Puntual del Funcionario/a y del Personal.
                  </div>

                  <div class="form-check form-switch col-sm-2">
                    <input type="checkbox" class="form-check-input evaluado_criterio_1" name="evaluado_criterio_1_1" id="evaluado_criterio_1_1" value="1" {{old('evaluado_criterio_1_1') == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="evaluado_criterio_1_1">Evaluable</label>
                  </div>

                  <div class="col-sm-1">
                    <input type="text" class="form-control" placeholder="" name="eps_1_1" value=" {{ old("eps_1_1") }} ">
                  </div>

                </div>

                <div class="row">
                  <div class="col">
                    <textarea class="form-control" name="obs_eps_1_1" id="obs_eps_1_1" placeholder="Observaciones">{{ old("obs_eps_1_1") }}</textarea>
                  </div>
                </div>

                <hr>

                <div class="row mb-3 mt-3">

                  <div class="col-sm-9">
                    1.2 Orden del Funcionario/a y del Personal.
                  </div>

                  <div class="form-check form-switch col-sm-2">
                    <input type="checkbox" class="form-check-input evaluado_criterio_1" name="evaluado_criterio_1_2" id="evaluado_criterio_1_2" value="1" {{old('evaluado_criterio_1_2') == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="evaluado_criterio_1_2">Evaluable</label>
                  </div>

                  <div class="col-sm-1">
                      <input type="text" class="form-control" placeholder="" name="eps_1_2" value=" {{ old("eps_1_2") }} ">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <textarea class="form-control" name="obs_eps_1_2" id="obs_eps_1_2" placeholder="Observaciones">{{ old("obs_eps_1_2") }}</textarea>
                  </div>
                </div>
              </div>
          
          </div>


          <div class="tab-pane fade" id="v-pills-criterio-dos" role="tabpanel" aria-labelledby="v-pills-criterio-dos-tab">
            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE LA SEDE JUDICIAL</p>
                <p class="criterio">CRITERIO DOS:</p>
                
                <div class="row">
                  <p class="subcriterio col-sm-10">Atención y Diligencia con el Público</p>
                  <div class="form-check form-switch col-sm-2">
                    <input type="checkbox" class="form-check-input" name="evaluado_criterio_2" id="evaluado_criterio_2" checked>
                    <label class="form-check-label" for="evaluado_criterio_2">Evaluable</label>
                  </div>
                </div>

                <hr>
                
                <div class="row mb-3 mt-3">
                  <div class="col-sm-9">
                    2.1 Atención con Respeto al Público
                  </div>
                  <div class="form-check form-switch col-sm-2">
                    <input type="checkbox" class="form-check-input evaluado_criterio_2" name="evaluado_criterio_2_1" id="evaluado_criterio_2_1" value="1" {{old('evaluado_criterio_2_1') == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="evaluado_criterio_2_1">Evaluable</label>
                  </div>
                  <div class="col-sm-1">
                    <input type="text" class="form-control" placeholder="" name="eps_2_1" value=" {{ old("eps_2_1") }} ">
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <textarea class="form-control" name="obs_eps_2_1" id="obs_eps_2_1" placeholder="Observaciones">{{ old("obs_eps_2_1") }}</textarea>
                  </div>
                </div>

                <hr>

                <div class="row mb-3 mt-3">
                  <div class="col-sm-9">
                    2.2 Diligencia con la que se Atiende al Público
                  </div>
                    <div class="form-check form-switch col-sm-2">
                      <input type="checkbox" class="form-check-input evaluado_criterio_2" name="evaluado_criterio_2_2" id="evaluado_criterio_2_2" value="1" {{old('evaluado_criterio_2_2') == 1 ? 'checked' : ''}}>
                      <label class="form-check-label" for="evaluado_criterio_2_2">Evaluable</label>
                  </div>
                  <div class="col-sm-1">
                    <input type="text" class="form-control" placeholder="" name="eps_2_2" value=" {{ old("eps_2_2") }} ">
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <textarea class="form-control" name="obs_eps_2_2" id="obs_eps_2_2" placeholder="Observaciones">{{ old("obs_eps_2_2") }}</textarea>
                  </div>
                </div>

            </div>
          </div>

          <div class="tab-pane fade" id="v-pills-criterio-tres" role="tabpanel" aria-labelledby="v-pills-criterio-tres-tab">
            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE LA SEDE JUDICIAL</p>
                <p class="criterio">CRITERIO TRES:</p>
                <p class="subcriterio">Orden y Conservación de los Archivos y Foliaje de los Expedientes</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="evaluado_criterio_3" id="evaluado_criterio_3" checked>
                        <label class="form-check-label" for="evaluado_criterio_3">Evaluable</label>
                    </div>
                    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              3.1 Orden General de la Oficina
                              <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="evaluado_criterio_3_1" id="evaluado_criterio_3_1" value="1" {{old('evaluado_criterio_3_1') == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="evaluado_criterio_3_1">Evaluable</label>
                              </div>
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="eps_3_1">
                        </div>
                    </div>

                    
        
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              3.2 Conservación de los Archivos y Localización de los Expedientes.
                              <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="evaluado_criterio_3_2" id="evaluado_criterio_3_2" value="1" {{old('evaluado_criterio_3_2') == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="evaluado_criterio_3_2">Evaluable</label>
                              </div>
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="eps_3_2">
                        </div>
                    </div>
    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              3.3 Foliaje de los Expedientes
                              <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="evaluado_criterio_3_3" id="evaluado_criterio_3_3" value="1" {{old('evaluado_criterio_3_3') == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="evaluado_criterio_3_3">Evaluable</label>
                              </div>
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="eps_3_3">
                        </div>
                    </div>

            </div>
          </div>

          <div class="tab-pane fade" id="v-pills-criterio-cuatro" role="tabpanel" aria-labelledby="v-pills-criterio-cuatro-tab">
            
            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE LA SEDE JUDICIAL</p>
                <p class="criterio">CRITERIO CUATRO:</p>
                <p class="subcriterio">Llevar los Libros Establecidos por Ley y demás que se Estimen Convenientes.</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="evaluado_criterio_4" id="evaluado_criterio_4" checked>
                        <label class="form-check-label" for="evaluado_criterio_4">Evaluable</label>
                    </div>
                    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              4.1 Llevar los Libros Establecidos por Ley y demás que se Estimen Convenientes.
                              <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="evaluado_criterio_4_1" id="evaluado_criterio_4_1" value="1" {{old('evaluado_criterio_4_1') == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="evaluado_criterio_4_1">Evaluable</label>
                              </div>
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="eps_4_1">
                        </div>
                    </div>
        
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              4.2 Actualización de los Libros.
                              <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="evaluado_criterio_4_2" id="evaluado_criterio_4_2" value="1" {{old('evaluado_criterio_4_2') == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="evaluado_criterio_4_2">Evaluable</label>
                              </div>
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="eps_4_2">
                        </div>
                    </div>

            </div>

          </div>

          <div class="tab-pane fade" id="v-pills-criterio-cinco" role="tabpanel" aria-labelledby="v-pills-criterio-cinco-tab">
            
            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE LA SEDE JUDICIAL</p>
                <p class="criterio">CRITERIO CINCO:</p>
                <p class="subcriterio">Despecho Oportuno de Documentos y Recepción en Forma de los Escritos o Peticiones.</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="evaluado_criterio_5" id="evaluado_criterio_5" checked>
                        <label class="form-check-label" for="evaluado_criterio_5">Evaluable</label>
                    </div>
                    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              5.1 Despacho Oportuno de los Documentos.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
        
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              5.2 Escritos y Peticiones Recibidas en Forma en la Sede Judicial.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
            </div>

          </div>

          <div class="tab-pane fade" id="v-pills-criterio-seis" role="tabpanel" aria-labelledby="v-pills-criterio-seis-tab">
            
            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE LA SEDE JUDICIAL</p>
                <p class="criterio">CRITERIO SEIS:</p>
                <p class="subtitulo">Otras Actividades Administrativas que Incluye la Remisión Oportunidad y Correcta de los Informes Únicos de Gestión y de la Asistencia y Aprovechamiento de Capacitaciones y de Información Adicional.</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="evaluado_criterio_6" id="evaluado_criterio_6" checked>
                        <label class="form-check-label" for="evaluado_criterio_6">Evaluable</label>
                    </div>
                    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              6.1 La Remisión Oportuna y Correcta de los Informes Únicos de Gestión.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
        
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              6.2 La Remisión Oportuna y Correcta de Información Judicial.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              6.3 Asistencia y Aprovechamiento de las Capacitaciones.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
            </div>
          </div>

          <div class="tab-pane fade" id="v-pills-criterio-siete" role="tabpanel" aria-labelledby="v-pills-criterio-siete-tab">
            
            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE JUSTICIA</p>
                <p class="criterio">CRITERIO SIETE:</p>
                <p class="subcriterio">Observancia de los Plazos Procesales para Resolver y para la Práctica de Diligencias Judiciales.</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="" id="evaluado_criterio_6" value="" checked>
                        <label class="form-check-label" for="evaluado_criterio_6">Evaluable</label>
                    </div>
                    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              7.1 El Cumplimiento de Plazos para Resolver y Remisión de Expedientes a Otras Sedes, Según Corresponda la Materia.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
        
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              7.2 Cumplimiento de Plazos para Realizar las Diligencias Referentes a los Actos de Comunicación.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              7.3 Cumplimiento de Plazos Judiciales de Comisiones Procesales.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              7.4 Cumplimiento de Plazos para el Señalamiento de Audiencias.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
    
            </div>

          </div>

          <div class="tab-pane fade" id="v-pills-criterio-ocho" role="tabpanel" aria-labelledby="v-pills-criterio-ocho-tab">

            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE JUSTICIA</p>
                <p class="criterio">CRITERIO OCHO:</p>
                <p class="subcriterio">Eficiencia y Productividad Judicial.</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="" id="evaluado_criterio_8" value="" checked>
                        <label class="form-check-label" for="evaluado_criterio_8">Evaluable</label>
                    </div>
                    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              8.1 Control de la Carga Laboral en el Periodo Evaluado.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
        
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              8.2 Cantidad de Comisiones Procesales Realizadas por el Funcionario/a en el Periodo Evaluado.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
    
            </div>

          </div>

          <div class="tab-pane fade" id="v-pills-criterio-nueve" role="tabpanel" aria-labelledby="v-pills-criterio-nueve-tab">
            <div class="criterios">
                <p class="titulo_criterio">EVALUACIÓN PRESENCIAL EN SEDE - ADMINISTRACIÓN DE JUSTICIA</p>
                <p class="criterio">CRITERIO NUEVE:</p>
                <p class="subcriterio">Omisión de Resoluciones en los Caos en que las Leyes Claramente Imponen el Deber de Resolver.</p>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="" id="evaluado_criterio_8" value="" checked>
                        <label class="form-check-label" for="evaluado_criterio_8">Evaluable</label>
                    </div>
                    
                    <div class="row mb-3 mt-3">
                        <div class="col">
                          <h6>
                              9.1 El Hallazgo de Omisión de Resoluciones en los Caos en que las Leyes Claramente Imponen el Deber de Resolver.
                          </h6>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="" name="">
                        </div>
                    </div>
    
            </div>
          </div>

          <div class="tab-pane fade" id="v-pills-criterio-diez" role="tabpanel" aria-labelledby="v-pills-criterio-diez-tab">
            fdsf
          </div>
          <div class="mt-4 d-md-flex justify-content-md-end">

            <input type="submit" value="Guardar" class="btn btn-primary">
          </div>

        </div>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      activarCheckBoxes('evaluado_criterio_1');
      activarCheckBoxes('evaluado_criterio_2');
      
  });

  desabilitarSwitchCuandoPrincipalNoEsteActivo("evaluado_criterio_1_1", "evaluado_criterio_1")
  desabilitarSwitchCuandoPrincipalNoEsteActivo("evaluado_criterio_1_2", "evaluado_criterio_1")

function desabilitarSwitchCuandoPrincipalNoEsteActivo($subcriterio, $criterio){
  gebid($subcriterio).addEventListener("click", function(){
    if(!gebid($criterio).checked){
      gebid($subcriterio).checked = false;
    }
  })
}
  

  

  function activarCheckBoxes(elemento){
      if(document.querySelector("#" + elemento) !== null){
          console.log(elemento)
          gebid(elemento).addEventListener('click', function(e){

          if(gebid(elemento).checked){
              checkAll('.' + elemento)
          }
          else{
              uncheckAll('.' + elemento)
          }
          })
      }
      else{console.log("OK")}
  }

  function checkAll(clase) {
      eQsa(clase).forEach(function(checkElement) {
          checkElement.checked = true;
      });
  }

  function uncheckAll(clase) {
      eQsa(clase).forEach(function(checkElement) {
          checkElement.checked = false;
      });
  }

  function gebid(elemento){
      return document.getElementById(elemento);
  }

  function eQsa(selector){
      return document.querySelectorAll(selector);
  }

</script>
</body>
</html>