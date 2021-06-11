<!-- AREA CHART -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">PRINCIPALES PERDIDAS POR CANCELACION DE CITA EN LA CLINICA</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="areaChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script>
    $(function() {
        // ChartJS
        var areaChartCanvas = $('#areaChart1').get(0).getContext('2d')

        var areaChartData = {
            labels: [

                <?php

                $column = null;
                $value = null;
                $table = "perdidas_por_cancelacion";

                $resultado = CitaControlador::ConsultarRegistroC($table, $column, $value);

                foreach ($resultado as $key => $values) {

                ?>

                    '<?php echo $values["NOMBRE"]; ?>',

                <?php } ?>

            ],
            datasets: [{
                label: 'Perdidas',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [
                    <?php

                    $column = null;
                    $value = null;
                    $table = "perdidas_por_cancelacion";

                    $resultado = CitaControlador::ConsultarRegistroC($table, $column, $value);

                    foreach ($resultado as $key => $values) {

                    ?>

                        '<?php echo $values["TOTAL"]; ?>',

                    <?php } ?>
                ]
            }, ]
        }

        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        new Chart(areaChartCanvas, {
            type: 'line',
            data: areaChartData,
            options: areaChartOptions
        })
    })
</script>