<?php

$ruta = ControladorRuta::ctrRuta();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>WEB HEALTH</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicon -->
    <link href="<?php echo $ruta; ?>views/img/favicon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo $ruta; ?>views/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $ruta; ?>views/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?php echo $ruta; ?>views/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo $ruta; ?>views/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?php echo $ruta; ?>views/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?php echo $ruta; ?>views/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo $ruta; ?>views/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo $ruta; ?>views/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo $ruta; ?>views/css/main.css" rel="stylesheet">

</head>

<body>

    <?php

    include "views/pages/top_bar.php";
    include "views/pages/header.php";
    include "views/pages/hero.php";
    include "views/pages/why_us.php";
    include "views/pages/about.php";
    include "views/pages/Counts.php";
    include "views/pages/services.php";
    //include "views/pages/appointment.php";
    include "views/pages/department.php";
    include "views/pages/doctor.php";
    include "views/pages/faq.php";
    include "views/pages/testimonials.php";
    include "views/pages/gallery.php";
    include "views/pages/contact.php";
    include "views/pages/footer.php";
    include "views/pages/preload.php";

    ?>

    <!-- Vendor JS Files -->
    <script src="<?php echo $ruta; ?>views/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo $ruta; ?>views/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $ruta; ?>views/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?php echo $ruta; ?>views/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo $ruta; ?>views/vendor/venobox/venobox.min.js"></script>
    <script src="<?php echo $ruta; ?>views/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?php echo $ruta; ?>views/vendor/counterup/counterup.min.js"></script>
    <script src="<?php echo $ruta; ?>views/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo $ruta; ?>views/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo $ruta; ?>views/js/main.js"></script>

</body>

</html>