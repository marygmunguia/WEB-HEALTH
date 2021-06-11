<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">NÚMERO DE CITAS POR ESPECIALIDAD</h3>
    </div>
    <div class="card-body">
        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
</div>

<script>
    $(function() {
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                <?php

                $column = null;
                $value = null;
                $table = "numero_citas_especialidad";

                $resultado = CitaControlador::ConsultarRegistroC($table, $column, $value);

                foreach ($resultado as $key => $values) {

                ?>

                    '<?php echo $values["NOMBRE"]; ?>',

                <?php } ?>
            ],
            datasets: [{
                data: [
                    <?php

                    $column = null;
                    $value = null;
                    $table = "numero_citas_especialidad";

                    $resultado = CitaControlador::ConsultarRegistroC($table, $column, $value);

                    foreach ($resultado as $key => $values) {

                    ?>

                        '<?php echo $values["TOTAL"]; ?>',

                    <?php } ?>
                ],
                backgroundColor: ['#AA9CAA', '#FFD700', '#00a65a', '#f56954', '#6495ED', '#FF4504', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })
    })
</script>