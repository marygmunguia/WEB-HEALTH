                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">INGRESOS POR ESPECIALIDADES</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>


                    <script>
                        $(function() {
                            // ChartJS

                            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                            var donutData = {
                                labels: [
                                    <?php

                                    $column = null;
                                    $value = null;
                                    $table = "ganancia_especialidad";

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
                                        $table = "ganancia_especialidad";

                                        $resultado = CitaControlador::ConsultarRegistroC($table, $column, $value);

                                        foreach ($resultado as $key => $values) {

                                        ?>

                                            '<?php echo $values["TOTAL"]; ?>',

                                        <?php } ?>
                                    ],
                                    backgroundColor: ['#0205A6', '#12AA00', '#FF334D', '#00c0ef', '#3c8dbc', '#d2d6de'],
                                }]
                            }
                            var donutOptions = {
                                maintainAspectRatio: false,
                                responsive: true,
                            }

                            new Chart(donutChartCanvas, {
                                type: 'doughnut',
                                data: donutData,
                                options: donutOptions
                            })
                        });
                    </script>