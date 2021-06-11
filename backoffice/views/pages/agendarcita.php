
                <?php
                    if(isset($_POST["CitaFecha"])){
                           
                        $agendarCita = new CitaControlador();
                        $agendarCita->AgendarCitaC();
                    }

                ?>