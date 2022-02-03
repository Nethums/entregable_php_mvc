<?php ob_start() ?>
    <h2>Buscar alumno en la base de datos</h2>
    <p>Introduce el nombre completo.</p>
    <form name="formBusqueda" action="index.php?ctl=buscarAlumno" method="POST">
        <input type="text" name="nombre" value="<?php echo $params['nombre']?>" placeholder="Introduce el nombre">
        <input type="submit" value="buscar" name="buscar">
    </form>

<?php if (count($params['resultado'])>0): ?>
<table>
    <tr>
        <th></th>
        <th>Nombre</th>
        <th>NIA</th>
        <th>E-mail)</th>
    </tr>
    <?php foreach ($params['resultado'] as $alumno) : ?>
    <tr>
        <td><img src="<?php echo "\\img\\alumnos". $alumno['fPerfil'] ?>" class="imagenLista"></td>
        <td><a href="index.php?ctl=ver&id=<?php echo $alumno['id'] ?>">
        <?php echo $alumno['nombre'] ?></a></td>
        <td><?php echo $alumno['nia'] ?></td>
        <td><?php echo $alumno['email'] ?></td>
    </tr>
    <?php endforeach; ?>

</table>
<?php endif; ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
