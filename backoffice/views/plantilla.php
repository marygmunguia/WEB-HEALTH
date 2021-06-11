<?php

session_start();

$ruta = ControladorRuta::ctrRuta();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="views/img/logo-clinica.png" type="image/x-icon">
  <title>WEB HEALTH</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/css/adminlte.min.css">
  <!-- ESTILOS PERSONALIZADOS -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/css/main.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/summernote/summernote-bs4.min.css">

  <!-- SweetAlert2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.js"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo $ruta ?>views/plugins/fullcalendar/main.css">

</head>

<body class="bg1" style="background-color: #fff;">

  <?php

  //DEFINIMOS LA ZONA HORARIOA DEL SISTEMA  
  date_default_timezone_set('America/Tegucigalpa');

  if (isset($_SESSION["Ingresar"]) && $_SESSION["Ingresar"] === 'ok') {

    if ($_SESSION["rol"] === "Administrador") {
  ?>
      <div class="hold-transition sidebar-mini">

        <div class="wrapper">

          <?php

          include "modules/cabecera.php";

          include "modules/menu_admin.php";

          ?>

          <div class="content-wrapper">

            <?php

            $url = array();

            if (isset($_GET["pagina"])) {

              $url = explode("/", $_GET["pagina"]);

              if (
                $url[0] == "principal-admin" ||
                $url[0] == "medico-registro" ||
                $url[0] == "especialidades" ||
                $url[0] == "usuarios" ||
                $url[0] == "admin-registro" ||
                $url[0] == "registro-enfermedades" ||
                $url[0] == "reportes" ||
                $url[0] == "perfil" ||
                $url[0] == "salas" ||
                $url[0] == "horario" ||
                $url[0] == "sintomas-comunes" ||
                $url[0] == "imp-registros" ||
                $url[0] == "salir"
              ) {

                include "views/pages/" . $url[0] . ".php";
              } else {

                include "views/modules/error404.php";
              }
            }
            ?>

          </div>

          <?php

          include "modules/pie_pagina.php";

          ?>

        </div>

      </div>

    <?php

    } elseif ($_SESSION["rol"] === "Médico") {

    ?>
      <div class="hold-transition sidebar-mini">

        <div class="wrapper">

          <?php
          include "modules/cabecera.php";

          include "modules/menu_md.php";

          ?>
          <div class="content-wrapper">

            <?php
            $url = array();

            if (isset($_GET["pagina"])) {

              $url = explode("/", $_GET["pagina"]);

              if (
                $url[0] == "principal-md" ||
                $url[0] == "perfil" ||
                $url[0] == "consultas-dia" ||
                $url[0] == "diagnostico" ||
                $url[0] == "crear-expediente" ||
                $url[0] == "imp-diagnostico" ||
                $url[0] == "agenda-consultas" ||
                $url[0] == "salir"
              ) {

                include "views/pages/" . $url[0] . ".php";
              } else {

                include "views/modules/error404.php";
              }
            }
            ?>

          </div>
          <?php
          include "modules/pie_pagina.php";
          ?>
        </div>

      </div>

    <?php

    } elseif ($_SESSION["rol"] === "Paciente") {

    ?>
      <div class="hold-transition sidebar-mini">

        <div class="wrapper">

          <?php

          include "modules/cabecera.php";

          include "modules/menu_paciente.php";

          ?>

          <div class="content-wrapper">

            <?php

            $url = array();

            if (isset($_GET["pagina"])) {

              $url = explode("/", $_GET["pagina"]);

              if (
                $url[0] == "principal-paciente" ||
                $url[0] == "perfil" ||
                $url[0] == "expediente" ||
                $url[0] == "cancelar-cita" ||
                $url[0] == "agendarcita" ||
                $url[0] == "reservar" ||
                $url[0] == "historial-paciente" ||
                $url[0] == "salir"
              ) {

                include "views/pages/" . $url[0] . ".php";
              } else {

                include "views/modules/error404.php";
              }
            }

            ?>

          </div>

          <?php

          include "modules/pie_pagina.php";

          ?>

        </div>

      </div>

  <?php

    }
  } elseif (isset($_GET["pagina"])) {
    if ($_GET["pagina"]) {
      if ($_GET["pagina"] == "inicio") {
        include "modules/inicio.php";
      } elseif ($_GET["pagina"] == "registro") {
        include "modules/registro.php";
      } else {
        include "modules/inicio.php";
      }
    }
  } else {
    include "modules/inicio.php";
  }
  ?>




  <!-- jQuery -->
  <script src="<?php echo $ruta ?>views/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo $ruta ?>views/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo $ruta ?>views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo $ruta ?>views/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo $ruta ?>views/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo $ruta ?>views/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo $ruta ?>views/plugins/moment/moment.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo $ruta ?>views/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo $ruta ?>views/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo $ruta ?>views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $ruta ?>views/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo $ruta ?>views/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo $ruta ?>views/js/pages/dashboard.js"></script>

  <!-- fullCalendar 2.2.5 -->
  <script src="<?php echo $ruta ?>views/plugins/moment/moment.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/fullcalendar/main.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/fullcalendar/locales/es.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="<?php echo $ruta ?>views/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo $ruta ?>views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- JS personalizado -->
  <script src="<?php echo $ruta ?>views/js/main.js"></script>
  <script src="<?php echo $ruta ?>views/js/horario.js"></script>
  <script src="<?php echo $ruta ?>views/js/especialidades.js"></script>
  <script src="<?php echo $ruta ?>views/js/reservar.js"></script>
  <script src="<?php echo $ruta ?>views/js/reportes.js"></script>

  <!-- CALENDARIO -->
  <script>
    var calendarEl = document.getElementById('calendario');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      themeSystem: 'bootstrap',
      locale: 'es',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaWeek,agendaDay'
      },
      editable: true,
      selectable: true,
      allDaySlot: false,
      hiddenDays: [0],
      dateClick: function(info) {

        var today = moment(new Date()).format('YYYY-MM-DD');

        var fecha = info.dateStr;

        if (fecha >= today) {
          $('#AgregarCita').modal();

          $('#txt_fecha').val(fecha);

          $('#fechacitam').val(fecha);

        } else {
          swal({
            icon: 'error',
            titltype: "error",
            title: "¡ERROR!",
            text: "NO PUEDES RESERVAR UNA CITA MÉDICA EN UN DÍA PASADO",
            showConfirmButtom: true,
            confirmButtomText: "Cerrar"
          });
        }
      }
    });

    calendar.render();
  </script>

</body>

</html>