<?php

class Alumnos extends Modelo {

    public function mostrarAlumnos() {
        $consulta = "select * 
                     from alumnos";
        
        $result = $this->conexion->query($consulta);
        return $result->fetchAll();
    }

    public function infoAlumno($id) {
        $consulta = "select * 
                     from alumnos 
                     where id=:id";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }

    public function asignaturasAlumno($id) {
        $consulta = "select asignaturas.nombre 
                     from asignaturas 
                     inner join clases 
                     on clases.idAsignatura = asignaturas.id 
                     where clases.idAlumno = :id";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetchAll();
    }

    




    public function buscarAlimentosPorNombre($nombre)
    {
        $consulta = "select * from alimentos where nombre like :nombre order by energia desc";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $nombre);
        $result->execute();

        return $result->fetchAll();
    }    
    

    public function insertarAlumno($nombre, $nia, $email, $direccion, $cPostal, $localidad, $fNacimiento, $fPerfil) {
        $consulta = "insert into alumnos (nombre, nia, email, direccion, cPostal, localidad, fNacimiento, fPerfil) values (?, ?, ?, ?, ?, ?, ?, ?)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $nombre);
        $result->bindParam(2, $nia);
        $result->bindParam(3, $email);
        $result->bindParam(4, $direccion);
        $result->bindParam(5, $cPostal);
        $result->bindParam(6, $localidad);
        $result->bindParam(7, $fNacimiento);
        $result->bindParam(8, $fPerfil);
        $result->execute();
        setcookie("usuarioId", $this->conexion->lastInsertId());
        return $result;
    }

    public function insertarAsignaturas($id) {
        $arrayAsignaturasUsuario = explode (",", $_COOKIE['asig'] );
// Arreglar función, sólo coge la última asignatura.
// Hay un problema con la Cookie de la id usuario porque coge el del usuario anterior
        
        if (in_array("dws", $arrayAsignaturasUsuario)) {
            $asignaturaDWS = "2";

            $consulta = "insert into clases (idAlumno, idAsignatura) values (?, ?)";

            $result = $this->conexion->prepare($consulta);
            $result->bindParam(1, $id);
            $result->bindParam(2, $asignaturaDWS);
            $result->execute();
            return $result;
        } 

        if (in_array("diw", $arrayAsignaturasUsuario)) {
            $asignaturaDIW = "0";

            $consulta2 = "insert into clases (idAlumno, idAsignatura) values (?, ?)";

            $result2 = $this->conexion->prepare($consulta);
            $result2->bindParam(1, $id);
            $result2->bindParam(2, $asignaturaDIW);
            $result2->execute();
            return $result2;
        } 
    }
}
