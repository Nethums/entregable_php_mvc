<?php
    ob_start();
?>

<div class="perfilAlumno">
    <h2><?php echo $params['alumnos']['nombre'] ?></h2>

    <?php
        echo "<img src='/img/alumnos/" . $params['alumnos']['fPerfil'] . "' class='fotoAlumno'>";
    ?> 
</div>



<table border="1" class="datosAlumno">

    <tr>
        <td>Nombre</td>
        <td><?php echo $params['alumnos']['nombre'] ?></td>
    </tr>

    <tr>
        <td>NIA</td>
        <td><?php echo $params['alumnos']['nia']?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $params['alumnos']['email']?></td>
    </tr>

    <tr>
        <td>Dirección</td>
        <td><?php echo $params['alumnos']['direccion'] . ' (' . $params['alumnos']['cPostal'] . ')'?></td>
    </tr>

    <tr>
        <td>Localidad</td>
        <td><?php echo $params['alumnos']['localidad']?></td>
    </tr>

    <tr>
        <td>Fecha nacimiento</td>
        <td><?php echo $params['alumnos']['fNacimiento']?></td>
    </tr>

    <tr>
        <td>Asignaturas</td>
        <td><?php 
            foreach ($asignaturas['alumnos'] as $asignaturas) {
                echo $asignaturas['nombre'] . ", ";
            } 
        ?></td>
    </tr>          
</table>

<div class="volverAtras">
    <?php
        echo "<a href='index.php?ctl=listar' class='bVolver'>Volver atrás</a>";
    ?>
</div>


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
