<?php ob_start() ?>

<div class="intro">
    <h2>Has cerrado sesión correctamente</h2>
    <p>Ahora estás navegando como usuario invitado.</p>
</div>



<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
