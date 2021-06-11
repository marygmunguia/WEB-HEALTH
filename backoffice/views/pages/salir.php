<?php

session_unset();
session_destroy();
$ruta = ControladorRuta::ctrRuta();

?>

<script>
    window.location = "<?php echo $ruta; ?>inicio";
</script>