<!-- ======= Departments Section ======= -->
<section id="departments" class="departments">
  <div class="container">

    <div class="section-title">
      <h2>Nuestras Especialidades</h2>
      <p class="font-italic">En WEB HEART encontrarás servicios y atención en medicina para la familia y soluciones para todo tipo de urgencias médicas.</p>
    </div>

    <div class="row">
      <div class="col-lg-3">
        <ul class="nav nav-tabs flex-column">
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Te atenderemos en: </a>
          </li>

        </ul>
      </div>

      <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="tab-content">
          <div class="tab-pane" id="tab-1">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>MÉDICINA GENERAL</h3>
                <p class="font-italic">Es el primer nivel de atención médica. La consulta está orientada al abordaje integral del paciente en su aspecto físico, mental y social.</p>
              </div>
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="assets/img/departments-1.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-2">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>MÉDICINA INTERNA</h3>
                <p class="font-italic">Especialidad médica que se dedica a la atención integral del adulto enfermo, enfocada al diagnóstico y el tratamiento no quirúrgico de las enfermedades que afectan a sus órganos y sistemas internos, y a su prevención
              </div>
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="assets/img/departments-2.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-3">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>GASTROTEROLOGÍA</h3>
                <p class="font-italic">Estudia al sistema digestivo, conformado por esófago, estómago, hígado, vía biliares, páncreas, los intestinos, colon y recto. Algunos de los procedimientos que se llevan a cabo dentro de esta rama médica son las colonoscopias, endoscopias y biopsias del hígado.
              </div>
              <!-- traer los demas registros desde la base de datos-->
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="assets/img/departments-3.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane active show" id="tab-4">
            <div class="row">
              <div class="col-lg-18 details order-5 order-lg-1">
                </br>
                <table id="ME" class="table table-hover EM">
                  <thead>
                    <tr>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $columna = null;
                    $valor = null;
                    $resultado = EspecialidadC::VerEspecialidadC($columna, $valor);
                    foreach ($resultado as $key => $value) {
                    ?>

                      <tr>

                        <td style="width: 10%;"> <?php echo $value["NOMBRE_ESPECIALIDAD"];  ?></td>
                        <td style="width: 40%;"><?php echo $value["DESCRIPCION"];  ?></td>


                      </tr>

                    <?php

                    }

                    ?>
                  </tbody>
                </table>
                <br />
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<!-- fin de extraer los datos -->

<div class="col-lg-4 text-center order-1 order-lg-2">
  <img src="assets/img/departments-4.jpg" alt="" class="img-fluid">
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section><!-- End Departments Section -->