<?php

require_once "conexionDB.php";

class CitaModelo extends ConexionDB
{

    static public function CancelarCitaM($tablaDB, $idcitamedica)
    {

        $pdo = ConexionDB::cDB()->prepare("UPDATE $tablaDB SET ID_ESTADO_CITA = '4' WHERE ID_CITA_MEDICA = :idcitamedica");

        $pdo->bindParam(":idcitamedica", $idcitamedica, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }



    static public function ConsultarRegistroM($tablaBD, $Columna, $Valor)
    {

        if ($Columna == null) {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaBD");

            $pdo->execute();

            return $pdo->fetchAll();
            
        } else {
            $stmt = ConexionDB::cDB()->prepare("SELECT * FROM $tablaBD WHERE $Columna = :$Columna");
            $stmt->bindParam(":" . $Columna, $Valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

            $stmt . close();
            $stmt = null;
        }
    }


    static public function ConsultarRegistrosM($tablaBD, $Columna, $Valor)
    {

        $stmt = ConexionDB::cDB()->prepare("SELECT * FROM $tablaBD WHERE $Columna = :$Columna");
        $stmt->bindParam(":" . $Columna, $Valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt . close();
        $stmt = null;
    }


    static public function ConsultaReporteM($tablaBD)
    {

        $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaBD");

        $pdo->execute();

        return $pdo->fetch();
    }

    static public function ConsultarRegistrosCompletosM($tablaBD, $Columna, $Valor, $Fecha)
    {

        $stmt = ConexionDB::cDB()->prepare("SELECT (HORA_INICIO) FROM $tablaBD WHERE $Columna = :$Columna AND FECHA_CITA = :fecha");
        $stmt->bindParam(":" . $Columna, $Valor, PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $Fecha, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt . close();
        $stmt = null;
    }

    static public function ConsultarHoraValidaM($tablaBD, $Columna, $Valor, $Fecha, $hora)
    {

        $stmt = ConexionDB::cDB()->prepare("SELECT (HORA_INICIO) FROM $tablaBD WHERE $Columna = :$Columna AND FECHA_CITA = :fecha AND HORA_INICIO = :hora");
        $stmt->bindParam(":" . $Columna, $Valor, PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $Fecha, PDO::PARAM_STR);
        $stmt->bindParam(":hora", $hora, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt . close();
        $stmt = null;
    }


    static public function ConsultarMedicoR($tablaBD, $Columna, $Valor)
    {

        if ($Columna == null) {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaBD");

            $pdo->execute();

            return $pdo->fetchAll();

            $pdo . close();
            $pdo = null;
        } else {
            $stmt = ConexionDB::cDB()->prepare("SELECT * FROM $tablaBD WHERE $Columna = :$Columna");

            $stmt->bindParam(":" . $Columna, $Valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

            $stmt . close();
            $stmt = null;
        }
    }


    static public function ConsultarPorFechaM($tablaBD, $fechaInicio, $fechaFinal)
    {

        $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaBD WHERE FECHA BETWEEN :inicio AND :final");
        $pdo->bindParam(":inicio", $fechaInicio, pdo::PARAM_STR);
        $pdo->bindParam(":final", $fechaFinal, pdo::PARAM_STR);

        $pdo->execute();

        return $pdo->fetchAll();
    }

    static public function NuevosUsuariosM($tabla, $fechaInicio, $fechaFinal)
    {

        $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tabla WHERE FECHA_REGISTRO BETWEEN :inicio AND :final");

        $pdo->bindParam(":inicio", $fechaInicio, pdo::PARAM_STR);
        $pdo->bindParam(":final", $fechaFinal, pdo::PARAM_STR);

        $pdo->execute();

        return $pdo->fetchAll();
    }

    static public function VerHistorialM($tablaDB, $columna, $valor)
    {
        if ($columna == null) {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB");

            $pdo->execute();

            return $pdo->fetchAll();
        } else {
            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna =:$columna");

            $pdo->bindParam(":" . $columna, $valor, pdo::PARAM_STR);

            $pdo->execute();

            return $pdo->fetchAll();
        }
    }


}



class DiagnosticoM
{
    //CREAR EXPEDIENTE
    static public function CrearExpediente($tabla, $idcliente)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tabla(ID_CLIENTE) VALUES (:idcliente)");

        $pdo->bindParam(":idcliente", $idcliente, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }


    //INSERTAR ENFERMEDAD BASE DEL PACIENTE
    static public function InsertarEnfermedad($tabla, $num_expediente, $valor)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tabla(NUM_EXPEDIENTE, CODIGO_ENFERMEDAD_BASE) 
        VALUES (:expediente, :enfermedad)");

        $pdo->bindParam(":expediente", $num_expediente, PDO::PARAM_STR);
        $pdo->bindParam(":enfermedad", $valor, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }

    //INSERTAR SINTOMA DEL PACIENTE
    static public function InsertarSintoma($tabla, $citamedica, $valor)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tabla(ID_SINTOMA_COMUN, ID_SINTOMA_CONSULTA) 
        VALUES (:sintoma, :citamedica)");

        $pdo->bindParam(":sintoma", $valor, PDO::PARAM_STR);
        $pdo->bindParam(":citamedica", $citamedica, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }

    //INSERTAR DIAGNOSTICO DEL PACIENTE
    static public function InsertarDiagnostico($tabla, $idcitamedica, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tabla(
             ID_CITA_MEDICA, SINTOMAS_EXPECIFICOS, ALTURA, PESO, TEMPERATURA, DIAGNOSTICO_MEDICO, RECETA_MEDICA
         ) 
         VALUES (:citamedica, :sintomas, :altura, :peso, :temperatura, :diagnostico, :receta)");

        $pdo->bindParam(":citamedica", $idcitamedica, PDO::PARAM_STR);
        $pdo->bindParam(":sintomas", $datosC["sintomasespecificos"], PDO::PARAM_STR);
        $pdo->bindParam(":altura", $datosC["altura"], PDO::PARAM_STR);
        $pdo->bindParam(":peso", $datosC["peso"], PDO::PARAM_STR);
        $pdo->bindParam(":temperatura", $datosC["temperatura"], PDO::PARAM_STR);
        $pdo->bindParam(":diagnostico", $datosC["diagnostico"], PDO::PARAM_STR);
        $pdo->bindParam(":receta", $datosC["receta"], PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }


    //INSERTAR DIAGNOSTICO DEL PACIENTE
    static public function ActualizarCita($tabla, $idcitamedica, $valor)
    {

        $pdo = ConexionDB::cDB()->prepare("UPDATE $tabla SET ID_ESTADO_CITA = :estado WHERE ID_CITA_MEDICA = :citamedica");

        $pdo->bindParam(":citamedica", $idcitamedica, PDO::PARAM_STR);
        $pdo->bindParam(":estado", $valor, PDO::PARAM_STR);

        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        return print_r(ConexionDB::cDB()->errorInfo());
    }
}
