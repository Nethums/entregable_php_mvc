<?php ob_start(); ?>

<h1>Aquí va el contenido de la página de Inicio</h1>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
