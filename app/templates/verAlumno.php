<?php
    ob_start();
    if (isset($params['mensaje'])) {
?>
    <b><span style="color: red;">
    <?php

    echo $params['mensaje'];
    echo "</span></b>";
    }  else { 
    ?>
        <h1><?php echo $params['alumnos']['nombre'] ?></h1>

        <?php

            echo "<img src='/img/alumnos/" . $params['alumnos']['fPerfil'] . "' class='fotoAlumno'>";

        ?>  

		<table border="1">

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

            <tr>           
            
			<?php
    }
    ?>  </table>

    <?php
        echo "<a href='index.php?ctl=listar'>Volver atrás</a>";
    ?>
<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
