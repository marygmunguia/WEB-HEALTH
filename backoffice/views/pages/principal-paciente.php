    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bienvenido(a): <?php echo $_SESSION["nombre"] . " " .  $_SESSION["apellido"]; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>Agendar Cita Médica</h4>
                            <p>Comienza a agendar tus citas de forma fácil y rápida</p>
                        </div>
                        <a href="reservar" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4>Editar Perfil</h4>
                            <p>Completa todas tu información de perfil para una mejor experiencia.</p>
                        </div>
                        <a href="perfil" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h4>Consulta tu historial</h4>
                            <p>Podrás consultar todas y cada una de tus citas completas o canceladas.</p>
                        </div>
                        <a href="historial-paciente" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4>Cancelar Cita</h4>
                            <p>No puedes llegar a tu cita por algún motivo, cancela rápidamente.</p>
                        </div>
                        <a href="cancelar-cita" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </section>