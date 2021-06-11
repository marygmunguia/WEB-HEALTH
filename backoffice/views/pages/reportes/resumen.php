<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <?php
                        $tablaDB = "utilidad_total";
                        $columna = null;
                        $valor = null;

                        $resultado = CitaControlador::ConsultaReporteC($tablaDB);

                        ?>
                        <h3>L. <?php echo $resultado["TOTAL"]; ?></h3>
                        <p>INGRESOS TOTALES</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-calculator"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <?php
                        $tablaDB1 = "total_clientes";

                        $resultado1 = CitaControlador::ConsultaReporteC($tablaDB1);

                        ?>
                        <h3><?php echo $resultado1["TOTAL REGISTRADOS"]; ?></h3>
                        <p>TOTAL CLIENTES REGISTRADOS</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <?php
                        $tablaDB = "total_citas_canceladas";
                        $columna = null;
                        $valor = null;

                        $resultado = CitaControlador::ConsultaReporteC($tablaDB);

                        ?>
                        <h3><?php echo $resultado["CANCELADAS"]; ?></h3>
                        <p>TOTAL CITAS CANCELADAS</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-close"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <?php
                        $tablaDB = "total_perdida_cancelacion";
                        $columna = null;
                        $valor = null;

                        $resultado = CitaControlador::ConsultaReporteC($tablaDB);

                        ?>
                        <h3>L. <?php echo $resultado["TOTAL"]; ?></h3>
                        <p>PERDIDA TOTAL POR CANCELACIÓN</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-alert"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>