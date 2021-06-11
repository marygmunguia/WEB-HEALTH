<?php

require_once "controllers/plantilla.controlador.php";
require_once "controllers/ruta.controlador.php";

require_once "controllers/usuarios.controlador.php";
require_once "models/usuarios.modelo.php";

require_once "controllers/salas.controlador.php";
require_once "models/salas.modelo.php";

require_once "controllers/especialidades.controlador.php";
require_once "models/especialidades.modelo.php";

require_once "controllers/medicos.controlador.php";
require_once "models/medicos.modelo.php";

require_once "controllers/persona.controlador.php";
require_once "models/persona.modelo.php";

require_once "controllers/enfermedadesbase.controlador.php";
require_once "models/enfermedadesbase.modelo.php";

require_once "controllers/paciente.controlador.php";
require_once "models/paciente.modelo.php";

require_once "controllers/citas.controlador.php";
require_once "models/citas.modelos.php";

require_once "controllers/sintomas.controlador.php";
require_once "models/sintomas.modelo.php";

require_once "controllers/reserva.controlador.php";
require_once "models/reserva.modelo.php";

require_once "extension/vendor/autoload.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();