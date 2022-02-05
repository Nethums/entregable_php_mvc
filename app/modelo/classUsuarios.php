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

    public function registrarUsuario($user, $pass, $email, $fPerfil) {

        $fPerfilRuta = $user . "\\" . $fPerfil;
        $nivel = "1";

        $consulta = "insert into usuarios (user, pass, nivel, email, fPerfil) values (?, ?, ?, ?, ?)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $user);
        $result->bindParam(2, $pass);
        $result->bindParam(3, $nivel);
        $result->bindParam(4, $email);
        $result->bindParam(5, $fPerfilRuta);
        $result->execute();
        
        return $result;
    }
    


}
