<div class="hold-transition login-page bg-1">
    <div class="log">
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <a href="inicio">WEB<b> HEART</b></a><br />
                    <img src="views/img/logo-clinica.png" alt="Logo">
                </div>
                <p class="login-box-msg">Introduce tus credenciales para ingresar al sistema</p>

                <form method="POST">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="correo" placeholder="Correo Electrónico">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="clave" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?php

                    $ingreso = new UsuarioControlador();
                    $ingreso->IngresoUsuarioC();

                    ?>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-1 btn-block">Ingresar</button>
                        </div>
                        <div class="col-12">
                            <a class="text-1" href="registro">¿No tienes una cuenta? ¡Registrate ya!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>