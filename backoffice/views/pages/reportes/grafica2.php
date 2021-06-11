<!-- AREA CHART -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">NÚMERO DE CITAS POR FECHA DE LOS ÚLTIMOS 7 DÍAS</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
</div>
<script>
    $(function() {
        // ChartJS
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        var areaChartData = {
            labels: [

                <?php

                $column = null;
                $value = null;
                $table = "fecha_citas";

                $resultado = CitaControlador::ConsultarPorFechasC($table, $column, $value);

                foreach ($resultado as $key => $values) {

                ?>

                    '<?php echo $values["FECHA"]; ?>',

                <?php } ?>

            ],
            datasets: [{
                label: 'NÚMERO DE CITAS',
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
                    $table = "fecha_citas";

                    $resultado = CitaControlador::ConsultarPorFechasC($table, $column, $value);

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