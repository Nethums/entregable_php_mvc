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

    public function insertarAlumno($nombre, $nia, $email, $direccion, $cPostal, $localidad, $fNacimiento, $fPerfil) {        

        $fPerfilRuta = "\\" . $nia . "\\" . $fPerfil;

        $consulta = "insert into alumnos (nombre, nia, email, direccion, cPostal, localidad, fNacimiento, fPerfil) values (?, ?, ?, ?, ?, ?, ?, ?)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $nombre);
        $result->bindParam(2, $nia);
        $result->bindParam(3, $email);
        $result->bindParam(4, $direccion);
        $result->bindParam(5, $cPostal);
        $result->bindParam(6, $localidad);
        $result->bindParam(7, $fNacimiento);
        $result->bindParam(8, $fPerfilRuta);
        $result->execute();
        
        return $result;
    }

    public function alumnoUltimaId() {
        $consultaId = "select max(id) from alumnos";
        $resultId = $this->conexion->query($consultaId);
        $alumnoUltimaId = $resultId->fetchColumn();
        return $alumnoUltimaId;
    } 

    public function insertarAsignaturas($id, $arrayAsignaturas) {        
        
        if (in_array("diw", $arrayAsignaturas)) {
            $asignaturaDIW = "0";

            $consulta0 = "insert into clases (idAlumno, idAsignatura) values (?, ?)";

            $result0 = $this->conexion->prepare($consulta0);
            $result0->bindParam(1, $id);
            $result0->bindParam(2, $asignaturaDIW);
            $result0->execute();
        } 
        
        if (in_array("dwc", $arrayAsignaturas)) {
            $asignaturaDWC = "1";

            $consulta1 = "insert into clases (idAlumno, idAsignatura) values (?, ?)";

            $result1 = $this->conexion->prepare($consulta1);
            $result1->bindParam(1, $id);
            $result1->bindParam(2, $asignaturaDWC);
            $result1->execute();
        }         


        if (in_array("dws", $arrayAsignaturas)) {
            $asignaturaDWS = "2";

            $consulta2 = "insert into clases (idAlumno, idAsignatura) values (?, ?)";

            $result2 = $this->conexion->prepare($consulta2);
            $result2->bindParam(1, $id);
            $result2->bindParam(2, $asignaturaDWS);
            $result2->execute();
        } 

        if (in_array("dam", $arrayAsignaturas)) {
            $asignaturaDAM = "3";

            $consulta3 = "insert into clases (idAlumno, idAsignatura) values (?, ?)";

            $result3 = $this->conexion->prepare($consulta3);
            $result3->bindParam(1, $id);
            $result3->bindParam(2, $asignaturaDAM);
            $result3->execute();
        } 

        if (in_array("dws", $arrayAsignaturas)) {
            $asignaturaEIE = "4";

            $consulta4 = "insert into clases (idAlumno, idAsignatura) values (?, ?)";

            $result4 = $this->conexion->prepare($consulta2);
            $result4->bindParam(1, $id);
            $result4->bindParam(2, $asignaturaEIE);
            $result4->execute();
        } 
    }

    public function buscarFichaAlumno($nombre) {
        $consulta = "select * from alumnos where nombre like :nombre order by nombre asc";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $nombre);
        $result->execute();

        return $result->fetchAll();
    }    
    


}
