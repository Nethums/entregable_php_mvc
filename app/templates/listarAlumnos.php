<?php ob_start() ?>

<table>
    <tr>
        <th>Nombre</th>
        <th>NIA</th>
        <th>Email</th>
    </tr>
        <?php foreach ($params['alumnos'] as $alumno) :?>
    <tr>
        <td><a href="index.php?ctl=ver&id=<?php echo $alumno['id']?>">
        <?php echo $alumno['nombre'] ?></a></td>
        <td><?php echo $alumno['nia']?></td>
        <td><?php echo $alumno['email']?></td>
    </tr>
    <?php endforeach; ?>

</table>


<?php 
$contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
