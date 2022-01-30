<?php

class Alumnos extends Modelo {

    public function mostrarAlumnos() {
        $consulta = "select * from alumnos";
        
        $result = $this->conexion->query($consulta);
        return $result->fetchAll();
    }

    public function infoAlumno($id) {
        $consulta = "select * from alumnos where id=:id";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':id', $id);
        $result->execute();
        return $result->fetch();
    }

    




    public function buscarAlimentosPorNombre($nombre)
    {
        $consulta = "select * from alimentos where nombre like :nombre order by energia desc";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $nombre);
        $result->execute();

        return $result->fetchAll();
    }    
    

    public function insertarAlimento($n, $e, $p, $hc, $f, $g)
    {
        $consulta = "insert into alimentos (nombre, energia, proteina, hidratocarbono, fibra, grasatotal) values (?, ?, ?, ?, ?, ?)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(1, $n);
        $result->bindParam(2, $e);
        $result->bindParam(3, $p);
        $result->bindParam(4, $hc);
        $result->bindParam(5, $f);
        $result->bindParam(6, $g);
        $result->execute();

        return $result;
    }
}
