<?php ob_start() ?>

<h2>Formulario para insertar nuevo alumno</h2>
<p>Todos los campos son obligatorios.</p>

<form name="formInsertar" action="index.php?ctl=insertarAlumno" method="POST" enctype="multipart/form-data">

    <input type="text" name="nombre" value="<?php echo $params['nombre'] ?>" placeholder="Nombre" />
    <input type="text" name="nia" value="<?php echo $params['nia'] ?>" placeholder="nia" />
    <input type="text" name="email" value="<?php echo $params['email'] ?>" placeholder="email"/>
    <input type="text" name="direccion" value="<?php echo $params['direccion'] ?>" placeholder="direccion"/>
    <input type="text" name="cPostal" value="<?php echo $params['cPostal'] ?>" placeholder="cPostal"/>
    <input type="text" name="localidad" value="<?php echo $params['localidad'] ?>" placeholder="localidad"/>
    <input type="text" name="fNacimiento" value="<?php echo $params['fNacimiento'] ?>" placeholder="fNacimiento"/>
    <input type="checkbox" name="asignaturas[]" value="diw">DIW<br>
    <input type="checkbox" name="asignaturas[]" value="dwc">DWC<br>
    <input type="checkbox" name="asignaturas[]" value="dws">DWS<br>
    <input type="checkbox" name="asignaturas[]" value="dam">DAM<br>
    <input type="checkbox" name="asignaturas[]" value="eie">EIE

    <input type="file" name="fPerfil"/>

    <input type="submit" value="insertar" name="insertar" />
</form>


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
