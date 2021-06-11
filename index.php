<?php

include "controllers/plantilla.controlador.php";
include "controllers/ruta.controlador.php";

require_once "controllers/especialidades.controlador.php";
require_once "models/especialidades.modelo.php";

$plantilla = new PlantillaControlador();

$plantilla -> ctrPlantilla();
