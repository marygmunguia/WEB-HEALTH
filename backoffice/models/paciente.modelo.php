<?php

class PacienteModelo{

    //CONSULTAR CODIGO DE PERSONA Y CODIGO DE USUARIO
    static public function consultarPersonaUsuarioM($view, $datosC)
    {

        $stmt = ConexionDB::cDB()->prepare("SELECT * FROM $view WHERE EMAIL = :email");
        $stmt->bindParam(":email", $datosC["email"], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt.close();
        $stmt = null;
    }

    // INSERTAR DATOS DEL MEDICO
    static public function CrearPacienteCliente($tablaDB3, $persona, $usuario)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB3(CODIGO_PERSONA, ID_USUARIO) 
        VALUES (:persona, :usuario)");

        $pdo->bindParam(":persona", $persona, PDO::PARAM_STR);
        $pdo->bindParam(":usuario", $usuario, PDO::PARAM_STR);


        if ($pdo->execute()) {
            return true;
        }else{
            return false;
        }

        $pdo.close();
        $pdo = null;
    }

}