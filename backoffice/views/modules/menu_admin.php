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


<!-- Menú lateral -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="<?php echo $ruta; ?>views/img/logo-clinica.png" alt="Logo" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">WEB HEALTH</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $ruta; ?><?php echo $_SESSION["foto_perfil"]; ?>" class="img-circle">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["nombre"]; ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="principal-admin" class="nav-link">
                        <i class="nav-icon fas fa-clinic-medical"></i>
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
                    <a href="usuarios" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuarios Registrados
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin-registro" class="nav-link">
                    <i class="nav-icon fas fa-users-cog"></i>
                        <p>Administradores</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="especialidades" class="nav-link">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>
                            Especialidades
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="medico-registro" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>
                            Médicos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="salas" class="nav-link">
                        <i class="nav-icon fas fa-briefcase-medical"></i>
                        <p>
                            Salas médicas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Otros Registros
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="registro-enfermedades" class="nav-link">
                                <i class="fas fa-stethoscope nav-icon"></i>
                                <p>Enfermedades Base</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="sintomas-comunes" class="nav-link">
                                <i class="fas fa-syringe nav-icon"></i>
                                <p>Sintomas Comunes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Reportes
                        </p><i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="imp-registros" class="nav-link">
                                <i class="fas fa-clipboard nav-icon"></i>
                                <p>Generar Reportes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="reportes" class="nav-link">
                                <i class="fas fa-chart-line nav-icon"></i>
                                <p>Ver Reportes Graficos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="salir" onclick="return ConfirmaCerrarSesion()" class="nav-link">
                        <i class="nav-icon fas fa-door-closed"></i>
                        <p>
                            Cerrar Sesión
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>