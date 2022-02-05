<?php ob_start(); ?>

<div class="intro">
    <h2>Ejercicio de Modelo-Vista-Controlador</h2>
    <p>Contenido página de inicio.</p>
</div>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
