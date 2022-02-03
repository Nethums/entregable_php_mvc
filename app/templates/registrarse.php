<?php ob_start() ?>
<h1>Aquí va el formulario de registro</h1>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
