<?php

class MedicoModelo
{
    //CONSULTAR CODIGO DE PERSONA Y CODIGO DE USUARIO
    static public function consultarPersonaUsuarioM($view, $datosC)
    {

        $stmt = ConexionDB::cDB()->prepare("SELECT * FROM $view WHERE EMAIL = :email");
        $stmt->bindParam(":email", $datosC["email"], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt . close();
        $stmt = null;
    }

    // INSERTAR DATOS DEL MEDICO
    static public function InsertarDoctorM($tablaDB3, $persona, $usuario, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB3(ID_PERSONA, ID_USUARIO, ID_ESPECIALIDAD, ID_SALA_MEDICA) 
        VALUES (:persona, :usuario, :especialidad, :sala)");

        $pdo->bindParam(":persona", $persona, PDO::PARAM_STR);
        $pdo->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $pdo->bindParam(":especialidad", $datosC["especialidad"], PDO::PARAM_STR);
        $pdo->bindParam(":sala", $datosC["sala"], PDO::PARAM_STR);


        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        $pdo . close();
        $pdo = null;
    }



    static public function MedicosRegistradosM($tablaDB, $columna, $valor)
    {
        if ($columna == null) {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB");

            $pdo->execute();

            return $pdo->fetchAll();

            $pdo . close();
            $pdo = null;
            
        } else {

            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna =:$columna");

            $pdo->bindParam(":" . $columna, $valor, pdo::PARAM_STR);

            $pdo->execute();

            return $pdo->fetch();

            $pdo . close();
            $pdo = null;
        }
    }

    static public function ConsultasDiaM($tablaDB, $columna1, $valor1, $columna2, $valor2)
    {
            $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna1 =:$columna1 AND $columna2 =:$columna2");
            
            $pdo->bindParam(":".$columna1, $valor1, PDO::PARAM_STR);
            $pdo->bindParam(":".$columna2, $valor2, PDO::PARAM_STR);
    
            $pdo->execute();

            return $pdo->fetchAll();

            $pdo . close();
            $pdo = null;

        } 

        static public function ConsultasAgendaM($tablaDB, $columna1, $valor1, $columna2, $valor2)
        {
                $pdo = ConexionDB::cDB()->prepare("SELECT * FROM $tablaDB WHERE $columna1 =:$columna1 AND $columna2 <> :$columna2");
                
                $pdo->bindParam(":".$columna1, $valor1, PDO::PARAM_STR);
                $pdo->bindParam(":".$columna2, $valor2, PDO::PARAM_STR);
        
                $pdo->execute();
    
                return $pdo->fetchAll();
    
                $pdo . close();
                $pdo = null;
    
            } 

    static public function RegistrarHorario($tablaDB, $idmedico, $datosC)
    {

        $pdo = ConexionDB::cDB()->prepare("INSERT INTO $tablaDB(ID_MEDICO, HORA_ENTRADA, HORA_SALIDA) 
        VALUES (:id, :horaE, :horaS)");

        $pdo->bindParam(":id", $idmedico, PDO::PARAM_INT);
        $pdo->bindParam(":horaE", $datosC["horaE"], PDO::PARAM_STR);
        $pdo->bindParam(":horaS", $datosC["horaS"], PDO::PARAM_STR);


        if ($pdo->execute()) {
            return true;
        } else {
            return false;
        }

        $pdo . close();
        $pdo = null;
    }
}
