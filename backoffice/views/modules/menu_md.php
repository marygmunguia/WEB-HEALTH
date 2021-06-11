<?php

$ruta = ControladorRuta::ctrRuta();

?>

<!-- Confirmar el cerrado de la sesión -->
<script>
    function ConfirmaCerrarSesion() {

        var respuesta = confirm("Deseas cerrar sesión definitivamente?", "CERRAR SESIÓN!");

        if (respuesta == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="principal-md" class="brand-link"> <img src="<?php echo $ruta; ?>views/img/logo-clinica.png" alt="img" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">WED HEALTH</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $ruta; ?><?php echo $_SESSION["foto_perfil"]; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["nombre"]; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="principal-md" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="perfil" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Perfil
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hospital-user"></i>
                        <p>
                            Consultas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="consultas-dia" class="nav-link">
                                <i class="fas fa-notes-medical nav-icon"></i>
                                <p>Consultas del Día</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="agenda-consultas" class="nav-link">
                                <i class="fas fa-address-book nav-icon"></i>
                                <p>Agenda de Consultas</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-head-side-virus"></i>
                        <p>
                            Pacientes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="imp-diagnostico" class="nav-link">
                                <i class="fas fa-file-medical nav-icon"></i>
                                <p>Imprimir Diagnostico</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="salir" onclick="return ConfirmaCerrarSesion();" class="nav-link">
                        <i class="nav-icon fas fa-external-link-alt"></i>
                        <p>
                            Salir
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>