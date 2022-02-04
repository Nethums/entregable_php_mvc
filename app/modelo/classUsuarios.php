<?php

class Usuarios extends Modelo {

    function loginUsuario($usuario, $password) {
        
        $consulta = "select * from usuarios where user=:usuario and pass=:clave"; 


        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':usuario', $usuario);
        $result->bindParam(':clave', $password);
        $result->execute();
        $filasConsulta = $result -> rowCount();
    
        if (!$filasConsulta) {            
            return FALSE;
        } else {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }
    


}
