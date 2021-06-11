<?php

class SintomasControlador
{

    //MOSTRAR REGISTROS
    static public function VerSintomasC($columna, $valor)
    {

        $tablaDB = "sintomas_comunes";

        $resultado = SintomasModelo::VerSintomasM($tablaDB, $columna, $valor);

        return $resultado;
    }


    //INSERTAR REGISTROS
    public function CrearSintomaC()
    {
        $ruta = ControladorRuta::ctrRuta();

        if (isset($_POST["nombre"])) {

            $tablaDB = "sintomas_comunes";

            $datosC = array(
                "nombre" => $_POST["nombre"],
                "obs" => $_POST["obs"]
            );

            $resultado = SintomasModelo::CrearSintomaM($tablaDB, $datosC);

            $ruta = ControladorRuta::ctrRuta();


            if ($resultado == true) {


?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA GUARDADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Aceptar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>sintomas-comunes";
                            }
                        })

                    });
                </script>

            <?php

            } else {


            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "error",
                            title: "¡ERROR!",
                            text: "NO SE HA GUARDADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>sintomas-comunes";
                            }
                        })

                    });
                </script>

            <?php

            }
        }
    }


    //BORRAR REGISTRO
    public function BorrarSintomaC()
    {
        if (isset($_POST["Did1"])) {

            $tablaDB = "sintomas_comunes";

            $datosC = $_POST["Did1"];

            $resultado = SintomasModelo::BorrarSintomaM($tablaDB, $datosC);

            $ruta = ControladorRuta::ctrRuta();

            if ($resultado == true) {
            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA ELIMINADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>sintomas-comunes";
                            }
                        })

                    });
                </script>

            <?php

            } else {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "error",
                            title: "¡ERROR!",
                            text: "NO SE HA ELIMINADO EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>sintomas-comunes";
                            }
                        })

                    });
                </script>

            <?php

            }
        }
    }


    //ACTUALIZAR REGISTROS

    public function ActualizarSintomaC()
    {

        if (isset($_POST["Did"])) {

           
            $tablaDB = "sintomas_comunes";

            $datosC = array(
                "id" => $_POST["Did"],
                "nombre" => $_POST["nombreE"],
                "obs" => $_POST["obsE"]
            );

            $resultado = SintomasModelo::ActualizarSintomaM($tablaDB, $datosC);

            $ruta = ControladorRuta::ctrRuta();


            if ($resultado == true) {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "success",
                            title: "¡CORRECTO!",
                            text: "SE HA ACTUALIZAR EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>sintomas-comunes";
                            }
                        })

                    });
                </script>

            <?php

            } else {

            ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {

                        swal({
                            titltype: "error",
                            title: "¡ERROR!",
                            text: "NO SE HA ACTUALIZAR EL REGISTRO SATISFACTORIAMENTE",
                            showConfirmButtom: true,
                            confirmButtomText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "<?php echo $ruta; ?>sintomas-comunes";
                            }
                        })

                    });
                </script>

<?php
            }
        }
    }
}
